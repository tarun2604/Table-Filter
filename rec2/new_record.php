<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Record</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Add New Record</h2>
    <form action="insert_record.php" method="POST">
    <div class="mb-3">
            <label class="form-label">Indexing:</label>
            <input type="text" name="indexing" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Employee ID:</label>
            <input type="text" name="Emp_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Paper Title:</label>
            <input type="text" name="paper_title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Journal Name:</label>
            <input type="text" name="journal_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Authors:</label>
            <input type="text" name="authors" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Indexing Type:</label>
            <input type="text" name="indexing_type" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Impact Factor:</label>
            <input type="text" name="impact_factor" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">SNIP:</label>
            <input type="text" name="snip" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">ISSN No:</label>
            <input type="text" name="issn_no" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Publication Date:</label>
            <input type="date" name="publication_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Year of Publication:</label>
            <input type="text" name="Year_of_publication" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Listed UGC:</label>
            <input type="text" name="listed_ugc" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Link WOS:</label>
            <input type="text" name="link_wos" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Link of Scopus:</label>
            <input type="text" name="link_of_scopus" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">UGC Link:</label>
            <input type="text" name="ugc_link" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Q1234NA:</label>
            <input type="text" name="Q1234NA" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Title of Conference:</label>
            <input type="text" name="title_of_conference" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Name of Conference:</label>
            <input type="text" name="name_of_conference" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
