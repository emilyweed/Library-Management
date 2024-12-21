<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book Burrow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; /* Soft, neutral background */
            color: #000000; 
        }
        header {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center-align the header content */
            justify-content: center;
            background-color: #556B2F;
            color: #B8860B; /* Deep forest green text color */
            padding: 30px 20px; /* Increased padding for a thicker header */
            border-bottom: 5px solid #B8860B;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        header h1 {
            margin: 0;
            font-family: 'Georgia', serif; /* More cozy font for the title */
        }
        header .login-button, header .search-bar, header .search-button {
            background-color: #f9f3e4; /* Creamy off-white for buttons */
            color: #2d4d3a; 
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        header .login-button:hover, header .search-bar:hover, header .search-button:hover {
            background-color: #FFFAF0; 
        }
        header .search-bar {
            width: 200px;
        }
        main {
            padding: 20px;
        }
        section {
            background: #fff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
        }
        section h2 {
            color: #6f4f29; /* Darker brown for headings */
            font-family: 'Georgia', serif;
        }
        .book-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            justify-items: center;
        }
        .book {
            background: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 300px;
        }
        .book img {
            width: 100px;
            height: 150px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .book strong {
            display: center;
            font-weight: bold;
            text-align: center;
        }
        .action-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .borrow-button {
            background-color: #28a745; /* Green for borrow button */
            color: white;
        }
        .hold-button {
            background-color: #ffc107; /* Yellow for hold button */
            color: white;
        }
        .show-more-button {
            background-color: #6f4f29; /* Dark brown for the show more button */
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
        .show-more-button:hover {
            background-color: #FFFAF0; 
        }
    </style>
</head>
<body>

    <header>
        <h1>The Book Burrow</h1>
		<div>
    		<a href="login.php">
        		<button class="login-button">Login</button>
    		</a>
    		<input type="text" class="search-bar" placeholder="Search books">
    		<button class="search-button">Search</button>
		</div>

    </header>

    <main>
        <!-- Recommendations Section -->
        <section>
            <h2>Recommended Books</h2>
            <div class="book-container">
                <?php
                $api_url = "https://openlibrary.org/search.json?q=harry+potter";
                $response = file_get_contents($api_url);
                $data = json_decode($response, true);

                if (isset($data['docs']) && count($data['docs']) > 0) {
                    foreach (array_slice($data['docs'], 0, 10) as $book) {
                        $title = $book['title'] ?? 'Unknown Title';
                        $author = $book['author_name'][0] ?? 'Unknown Author';
                        $year = $book['first_publish_year'] ?? 'Unknown Year';
                        $cover_id = $book['cover_i'] ?? null; // Check for cover ID
                        $cover_url = $cover_id ? "https://covers.openlibrary.org/b/id/$cover_id-L.jpg" : 'https://via.placeholder.com/100x150?text=No+Cover'; // Default if no cover

                        echo "<div class='book'>";
                        echo "<img src='$cover_url' alt='Book Cover'>";
                        echo "<div>";
                        echo "<strong>Title:</strong> $title<br>";
                        echo "<strong>Author:</strong> $author<br>";
                        echo "<strong>Publication Year:</strong> $year<br>";
                        echo "<div class='action-buttons'>";
                        echo "<button class='borrow-button' onclick=\"alert('Borrowed: $title')\">Borrow</button>";
                        echo "<button class='hold-button' onclick=\"alert('Placed on Hold: $title')\">Hold</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No recommendations available.";
                }
                ?>
            </div>
        </section>

        <!-- Available Media Section -->
        <section>
            <h2>Available Media</h2>
            <div class="book-container">
                <?php
                $api_url = "https://openlibrary.org/search.json?q=available"; // Replace 'available' with your desired search query
                $response = file_get_contents($api_url);
                $data = json_decode($response, true);

                if (isset($data['docs']) && count($data['docs']) > 0) {
                    foreach (array_slice($data['docs'], 0, 10) as $book) {
                        $title = $book['title'] ?? 'Unknown Title';
                        $author = $book['author_name'][0] ?? 'Unknown Author';
                        $year = $book['first_publish_year'] ?? 'Unknown Year';
                        $cover_id = $book['cover_i'] ?? null; // Check for cover ID
                        $cover_url = $cover_id ? "https://covers.openlibrary.org/b/id/$cover_id-L.jpg" : 'https://via.placeholder.com/100x150?text=No+Cover'; // Default if no cover

                        echo "<div class='book'>";
                        echo "<img src='$cover_url' alt='Book Cover'>";
                        echo "<div>";
                        echo "<strong>Title:</strong> $title<br>";
                        echo "<strong>Author:</strong> $author<br>";
                        echo "<strong>Publication Year:</strong> $year<br>";
                        echo "<div class='action-buttons'>";
                        echo "<button class='borrow-button' onclick=\"alert('Borrowed: $title')\">Borrow</button>";
                        echo "<button class='hold-button' onclick=\"alert('Placed on Hold: $title')\">Hold</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No media available at the moment.";
                }
                ?>
            </div>
            <!-- Show More Books Button -->
            <button class="show-more-button" onclick="window.location.href='more_books.php'">Show More Books</button>
        </section>
    </main>

</body>
</html>