<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - Parents in Sync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .navbar {
            background-color: #0fd0fb;
        }
        .resource-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
            margin-bottom: 20px;
        }
        .resource-link {
            color: #0066cc;
            text-decoration: none;
        }
        .resource-link:hover {
            text-decoration: underline;
        }
        .book-title {
            color: #0066cc;
        }
        .author {
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Parents in Sync</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="home2.html">Home</a>
                    <a class="nav-link" href="aboutus.php">About Us</a>
                    <a class="nav-link" href="forum.php">Forum</a>
                    <a class="nav-link" href="resources.php">Resources</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="mb-4">Parenting Resources</h1>
        
        <div class="row">
            <!-- Parenting Books -->
            <div class="col-lg-6">
                <div class="resource-card">
                    <h2 class="h3 mb-3">Parenting Books</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="book-title">The Whole-Brain Child</span> 
                            <span class="author">by Daniel J. Siegel and Tina Payne Bryson</span>
                        </li>
                        <li class="mb-3">
                            <span class="book-title">How to Talk So Kids Will Listen & Listen So Kids Will Talk</span>
                            <span class="author">by Adele Faber and Elaine Mazlish</span>
                        </li>
                        <li class="mb-3">
                            <span class="book-title">The Happiest Baby on the Block</span>
                            <span class="author">by Harvey Karp</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Helpful Websites -->
            <div class="col-lg-6">
                <div class="resource-card">
                    <h2 class="h3 mb-3">Helpful Websites</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="#" class="resource-link">KellyMom</a> - Evidence-based breastfeeding and parenting
                        </li>
                        <li class="mb-3">
                            <a href="#" class="resource-link">Zero to Three</a> - Early childhood development resources
                        </li>
                        <li class="mb-3">
                            <a href="#" class="resource-link">Common Sense Media</a> - Age-based media reviews for families
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Local Support Services -->
            <div class="col-12">
                <div class="resource-card">
                    <h2 class="h3 mb-3">Local Support Services</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <strong>Nairobi Parent Support Group</strong> - Weekly meetings at Community Center
                        </li>
                        <li class="mb-3">
                            <strong>Kenya Pediatric Association</strong> - Find a pediatrician near you
                        </li>
                        <li class="mb-3">
                            <strong>Postpartum Support Kenya</strong> - Helpline and support groups
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
    <!-- Footer -->
<footer class="footer mt-auto py-3 bg-light footer">
    <div class="container">
        <div class="text-center">
            <p class="text-muted mb-0">&copy; 2024 Parents in Sync. All rights reserved.</p>
        </div>
    </div>
</footer>
</html>