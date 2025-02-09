<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabulator</title>
  <link href="https://unpkg.com/tabulator-tables@5.0.7/dist/css/tabulator.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <h1>Table</h1>
  <div class="controls">
    <input type="file" id="fileInput" />
    <button class="btn" onclick="importCSV().catch(error => console.error(error))">Import CSV</button>
  </div>
  <button class="btn"><a href="new_record.php">Add Record</a></button>
  
  <div class="controls" style="margin: 20px;">
    <select id="filter-field">
      <option value="">Select Field</option>
      <option value="indexing">Indexing</option>
      <option value="Emp_id">Employee ID</option>
      <option value="paper_title">Paper Title</option>
      <option value="journal_name">Journal Name</option>
      <option value="authors">Authors</option>
      <option value="indexing_type">Indexing Type</option>
      <option value="impact_factor">Impact Factor</option>
      <option value="snip">SNIP</option>
      <option value="issn_no">ISSN Number</option>
      <option value="publication_date">Publication Date</option>
      <option value="Year_of_publication">Year of Publication</option>
      <option value="listed_ugc">Listed UGC</option>
      <option value="link_wos">Link to WoS</option>
      <option value="link_of_scopus">Link to Scopus</option>
      <option value="ugc_link">UGC Link</option>
      <option value="Q1234NA">Q1234NA</option>
      <option value="title_of_conference">Title of Conference</option>
      <option value="name_of_conference">Name of Conference</option>
    </select>
    
    <select id="filter-operator">
      <option value="like">Contains</option>
      <option value="not like">Not Contains</option>
      <option value="=">Equals</option>
      <option value="!=">Not Equal</option>
    </select>
    
    <input type="text" id="filter-value" placeholder="Filter Value" />
    <button class="btn" onclick="applyFilter()">Apply Filter</button>
    <button class="btn" onclick="clearFilters()">Clear Filters</button>
    <button class="btn" onclick="downloadCSV()">Download CSV</button>
  </div>

  <div id="tableContainer" style="margin-top: 20px;"></div>
</div>

<div id="editModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
  <h2>Edit Row</h2>
  <form id="editForm">
    <div id="formFields"></div>
    <button type="button" onclick="saveChanges()">Save Changes</button>
    <button type="button" onclick="closeModal()">Cancel</button>
  </form>
</div>

<script src="https://unpkg.com/tabulator-tables@5.0.7/dist/js/tabulator.min.js"></script>

<script>
  const columns = [
    { title: "Si_no", field: "Si_no", visible: false }, // Add this line
    { title: "Indexing", field: "indexing" },
    { title: "Employee ID", field: "Emp_id" },
    { title: "Paper Title", field: "paper_title" },
    { title: "Journal Name", field: "journal_name" },
    { title: "Authors", field: "authors" },
    { title: "Indexing Type", field: "indexing_type" },
    { title: "Impact Factor", field: "impact_factor" },
    { title: "SNIP", field: "snip" },
    { title: "ISSN Number", field: "issn_no" },
    { title: "Publication Date", field: "publication_date" },
    { title: "Year of Publication", field: "Year_of_publication" },
    { title: "Listed UGC", field: "listed_ugc" },
    { title: "Link WoS", field: "link_wos" },
    { title: "Link Scopus", field: "link_of_scopus" },
    { title: "UGC Link", field: "ugc_link" },
    { title: "Quartile", field: "Q1234NA" },
    { title: "Title of Conference", field: "title_of_conference" },
    { title: "Name of Conference", field: "name_of_conference" },
    {
      title: "Action",
      field: "action",
      formatter: function(cell, formatterParams, onRendered) {
        let Si_no = cell.getRow().getData().Si_no; 
        return `<button class="btn btn-sm btn-primary" onclick="editRow('${Si_no}')">Edit</button>, <button class="btn btn-sm btn-danger" onclick="deleteRow('${Si_no}')">Delete</button>`;
      },
      width: 200
    }
  ];

  const table = new Tabulator("#tableContainer", {
    columns: columns,
    layout: "fitData",
    ajaxURL: "fetch_data.php",
    ajaxResponse: function (url, params, response) {
      return response;
    },
    pagination: "local",
    paginationSize: 10,
    placeholder: "No Data Available",
  });

  function editRow(Si_no) {
    window.location.href = `edit.php?Si_no=${encodeURIComponent(Si_no)}`;
  }

  let currentRowData = null;

  function openEditForm(rowData) {
    currentRowData = rowData;
    const formFieldsContainer = document.getElementById("formFields");
    formFieldsContainer.innerHTML = "";

    Object.keys(rowData).forEach(field => {
      if (field !== "action") {
        formFieldsContainer.innerHTML += `
          <label>${field}</label>
          <input type="text" id="form_${field}" value="${rowData[field]}" style="width: 100%; margin-bottom: 10px;">
        `;
      }
    });

    document.getElementById("editModal").style.display = "block";
  }

  function saveChanges() {
    if (!currentRowData) return;

    const updatedData = {};
    Object.keys(currentRowData).forEach(field => {
        if (field !== "action") {
            updatedData[field] = document.getElementById(`form_${field}`).value;
        }
    });

    fetch("update_data.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(updatedData),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Row updated successfully!");
            window.location.href = "index.php";
        } else {
            alert("Error updating row: " + data.error);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while updating the row.");
    });
  }

  function closeModal() {
    document.getElementById("editModal").style.display = "none";
  }

  function applyFilter() {
    const filterField = document.getElementById("filter-field").value;
    const filterOperator = document.getElementById("filter-operator").value;
    const filterValue = document.getElementById("filter-value").value;

    if (filterField && filterValue) {
      const filter = { field: filterField, type: filterOperator, value: filterValue };
      table.setFilter(filterField, filterOperator, filterValue);
    } else {
      alert("Please select a field and provide a value to filter.");
    }
  }

  function clearFilters() {
    table.clearFilter();
    document.getElementById("filter-field").value = "";
    document.getElementById("filter-operator").value = "like";
    document.getElementById("filter-value").value = "";
  }

  function downloadCSV() {
    table.download("csv", "table_data.csv");
  }

  async function importCSV() {
  const fileInput = document.getElementById("fileInput");
  const file = fileInput.files[0];

  if (file) {
    const formData = new FormData();
    formData.append("csvFile", file);

    try {
      const response = await fetch("import_csv.php", {
        method: "POST",
        body: formData,
      });
      
      const data = await response.json();
      
      if (data.success) {
        alert("Data imported successfully!");
        await table.setData("fetch_data.php");
        fileInput.value = ''; // Clear the file input
      } else {
        alert("Error importing data: " + data.error);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred while importing the data.");
    }
  } else {
    alert("Please select a file to import.");
  }
}

function deleteRow(Si_no) {
    if (confirm('Are you sure you want to delete this record?')) {
        console.log("Attempting to delete Si_no:", Si_no);  // Debug log

        fetch("delete_record.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ Si_no: Si_no })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Delete response:", data);  // Debug log
            if (data.success) {
                const rowToDelete = table.getRow(Si_no);
                if (rowToDelete) {
                    rowToDelete.delete();
                }
                alert('Record deleted successfully');
            } else {
                alert('Error deleting record: ' + data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("An error occurred while deleting the record.");
        });
    }
}

</script>

</body>
</html>
<script>
// Add these elements to your HTML controls div
const filterContainer = document.createElement('div');
filterContainer.innerHTML = `
  <div class="filter-group">
    <select class="filter-gate">
      <option value="AND">AND</option>
      <option value="OR">OR</option>
    </select>
    <button class="btn" onclick="addFilterRow()">Add Filter</button>
    <div id="filterRows"></div>
  </div>
`;
document.querySelector('.controls').appendChild(filterContainer);

function addFilterRow() {
  const row = document.createElement('div');
  row.className = 'filter-row';
  row.innerHTML = `
    <select class="filter-field">
      ${document.getElementById('filter-field').innerHTML}
    </select>
    <select class="filter-operator">
      ${document.getElementById('filter-operator').innerHTML}
    </select>
    <input type="text" class="filter-value" placeholder="Filter Value">
    <button class="btn" onclick="removeFilterRow(this)">Remove</button>
  `;
  document.getElementById('filterRows').appendChild(row);
}

function removeFilterRow(button) {
  button.parentElement.remove();
  applyMultipleFilters();
}

function applyMultipleFilters() {
  const rows = document.getElementsByClassName('filter-row');
  const gate = document.querySelector('.filter-gate').value;
  const filters = [];

  for (const row of rows) {
    const field = row.querySelector('.filter-field').value;
    const operator = row.querySelector('.filter-operator').value;
    const value = row.querySelector('.filter-value').value;

    if (field && value) {
      filters.push([field, operator, value]);
    }
  }

  if (filters.length > 0) {
    table.setFilter(gate === 'AND' ? 'and' : 'or', filters);
  } else {
    table.clearFilter();
  }
}

// Update clear filters function
function clearFilters() {
  table.clearFilter();
  document.getElementById('filterRows').innerHTML = '';
  document.querySelector('.filter-gate').value = 'AND';
}
</script>
<div class="controls" style="margin: 20px;">
  <input type="text" id="globalSearch" placeholder="Global Search" onkeyup="applyGlobalSearch()" style="width: 100%; margin-bottom: 10px;">
</div>

<script>
function applyGlobalSearch() {
  const searchValue = document.getElementById("globalSearch").value;
  table.setFilter([
    { field: "indexing", type: "like", value: searchValue },
    { field: "Emp_id", type: "like", value: searchValue },
    { field: "paper_title", type: "like", value: searchValue },
    { field: "journal_name", type: "like", value: searchValue },
    { field: "authors", type: "like", value: searchValue },
    { field: "indexing_type", type: "like", value: searchValue },
    { field: "impact_factor", type: "like", value: searchValue },
    { field: "snip", type: "like", value: searchValue },
    { field: "issn_no", type: "like", value: searchValue },
    { field: "publication_date", type: "like", value: searchValue },
    { field: "Year_of_publication", type: "like", value: searchValue },
    { field: "listed_ugc", type: "like", value: searchValue },
    { field: "link_wos", type: "like", value: searchValue },
    { field: "link_of_scopus", type: "like", value: searchValue },
    { field: "ugc_link", type: "like", value: searchValue },
    { field: "Q1234NA", type: "like", value: searchValue },
    { field: "title_of_conference", type: "like", value: searchValue },
    { field: "name_of_conference", type: "like", value: searchValue }
  ], "or");
}
</script>