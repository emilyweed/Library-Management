<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More Books - The Book Burrow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #4d4d4d;
        }
        header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f4a261;
            color: #2d4d3a;
            padding: 30px 20px;
            border-bottom: 5px solid #d4a370;
            background: linear-gradient(45deg, #f4a261, #e76f51);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-family: 'Georgia', serif;
        }
        header .login-button, header .search-bar {
            background-color: #f9f3e4;
            color: #2d4d3a;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        header .login-button:hover, header .search-bar:hover {
            background-color: #e2cfa9;
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
            color: #6f4f29;
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
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .book img {
            width: 100px;
            height: 150px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .book strong {
            display: block;
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
            background-color: #28a745;
            color: white;
        }
        .hold-button {
            background-color: #ffc107;
            color: white;
        }
    </style>
</head>
<body>

    <header>
        <h1>The Book Burrow - More Books</h1>
        <div>
            <button class="login-button">Login</button>
            <input type="text" class="search-bar" placeholder="Search books">
            <button class="search-button">Search</button>
        </div>
    </header>

    <main>
        <!-- More Books Section -->
        <section>
            <h2>More Books</h2>
            <div class="book-container">
                <?php
                $api_url = "https://openlibrary.org/search.json?q=fiction&offset=10";
                $response = file_get_contents($api_url);
                $data = json_decode($response, true);

                if (isset($data['docs']) && count($data['docs']) > 0) {
                    foreach ($data['docs'] as $book) {
                        $title = $book['title'] ?? 'Unknown Title';
                        $author = $book['author_name'][0] ?? 'Unknown Author';
                        $year = $book['first_publish_year'] ?? 'Unknown Year';
                        $cover_id = $book['cover_i'] ?? null;
                        $cover_url = $cover_id ? "https://covers.openlibrary.org/b/id/$cover_id-L.jpg" : 'https://via.placeholder.com/100x150?text=No+Cover';

                        echo "<div class='book'>";
                        echo "<img src='$cover_url' alt='Book Cover'>";
                        echo "<div>";
                        echo "<strong>Title:</strong> $title";
                        echo "<strong>Author:</strong> $author";
                        echo "<strong>Year:</strong> $year";
                        echo "<div class='action-buttons'>";
                        echo "<button class='borrow-button' onclick=\"alert('Borrowed: $title')\">Borrow</button>";
                        echo "<button class='hold-button' onclick=\"alert('Placed on Hold: $title')\">Hold</button>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No more books available.";
                }
                ?>
            </div>
        </section>
    </main>

</body>
</html>