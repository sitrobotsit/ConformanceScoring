<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Accessibility List (PAL)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nsw-design-system@3/dist/css/main.css">
    <script>
        function filterTable() {
            var selectBox = document.getElementById('categoryFilter');
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var table = document.getElementById('dataTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName('td')[3]; // Adjusted to the 8th column for Category
                if (td) {
                    var textValue = td.textContent || td.innerText;
                    if (textValue.indexOf(selectedValue) > -1 || selectedValue === 'All') {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>
</head>

<body>
    <div class="nsw-container">
        <div class="nsw-layout">
            <main class="nsw-layout__main">
                <h1>Product Accessibility List (PAL)</h1>
               <p>Date products recorded: 1 May 2024</p>
                <ul>
                    <li><a href="https://ozewai.org/resources/about-the-ozewai-product-accessibility-list-pal/">Read
                            about the Product Accessibility List (PAL)</a> and how  products are scored</li>
                    <li>Complete the <a href="https://forms.gle/ioYRFMNWAyrHwmoi6">Send a product form</a> to share products
                        for OZeWAI to score and add to the PAL.</li>
                    <li><a href="https://ozewai.org/resources/about-the-ozewai-product-accessibility-list-pal#PAL-feedback">Provide feedback about the OZeWAI PAL</a>, how we can improve it and how vendors can update their information.</li>
                    
                </ul>

                <div class="nsw-form">


                    <div class="nsw-form__group">
                        <label class="nsw-form__label" for="categoryFilter">Filter by Category:</label>
                        <select class="nsw-form__select" id="categoryFilter" onchange="filterTable()"
                            class="nsw-form-select">
                            <option value="All">All</option>
                            <?php

                            // $jsonData = file_get_contents('conformance-data.json');
                            $jsonData = file_get_contents('https://raw.githubusercontent.com/sitrobotsit/ConformanceScoring/main/conformance-scoring/conformance-data.json');
                            $data = json_decode($jsonData, true);
                            $categories = array_unique(array_column($data, 'Category'));
                            foreach ($categories as $category) {
                                echo "<option value='" . htmlspecialchars($category) . "'>" . htmlspecialchars($category) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>




                <div class="nsw-table nsw-table--striped" tabindex="0">

                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>Vendor</th>
                                <th>Product</th>
                                <th>PAL Risk Rating</th>
                                <th>Category</th>
                                <th>Accessible Percent</th>
                                <th>WCAG A</th>
                                <th>WCAG AA</th>
                                <th>Accessibility Statement</th>
                                <th>Accessibility Conformance Report (ACR)</th>
                                <th>VPAT details</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jsonData = file_get_contents('https://raw.githubusercontent.com/sitrobotsit/ConformanceScoring/main/conformance-scoring/conformance-data.json');
                            $data = json_decode($jsonData, true);

                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td><a href='" . htmlspecialchars($row['Vendor URL']) . "'>" . htmlspecialchars($row['Vendor']) . "</a>";

                                // Check if Product URL has data
                                if ($row['Product URL']) {
                                    echo "<td><a href='" . htmlspecialchars($row['Product URL']) . "'>" .
                                        htmlspecialchars($row['Product']) . "</a>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Product']) . "</td>";
                                }

                                echo "<td>" . htmlspecialchars($row['PAL Risk Rating']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Category']) . "</td>";

                                echo "<td>" . htmlspecialchars($row['Accessible Percent'] * 100) . "%</td>";


                                echo "<td>" . htmlspecialchars($row['WCAG A']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['WCAG AA']) . "</td>";


                                // Check if Accessibility Statement data starts with "http"
                                if (strpos($row['Accessibility Statement'], 'http') === 0) {
                                    echo "<td><a href='" . htmlspecialchars($row['Accessibility Statement']) . "'>" . htmlspecialchars($row['Product']) . " Accessibility Statement</a>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Accessibility Statement']) . "</td>";
                                }



                                // Check if ACR data starts with "http"
                                if (strpos($row['Accessibility Conformance Report (ACR)'], 'http') === 0) {
                                    echo "<td><a href='" . htmlspecialchars($row['Accessibility Conformance Report (ACR)']) . "'>" . htmlspecialchars($row['Product']) . " Accessibility Conformance Report (ACR)</a>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Accessibility Conformance Report (ACR)']) . "</td>";
                                }
                             echo "<td>" . htmlspecialchars($row['VPAT details']) . "</td>"
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/nsw-design-system@3/dist/js/main.min.js"></script>
    <script>
        window.NSW.initSite();
    </script>
</body>

</html>
