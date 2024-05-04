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
                <h1>Product Accessibility List (PAL) - BETA</h1>
                <p>Date products recorded: 1 May 2024</p>
                <ul>
                    <li><a href="https://ozewai.org/resources/about-the-ozewai-product-accessibility-list-pal/">Read
                            about the Product Accessibility List (PAL)</a> and how products are scored</li>
                    <li>Complete the <a href="https://forms.gle/ioYRFMNWAyrHwmoi6">Send a product form</a> to share
                        products
                        for OZeWAI to score and add to the PAL.</li>
                    <li><a
                            href="https://ozewai.org/resources/about-the-ozewai-product-accessibility-list-pal#PAL-feedback">Provide
                            feedback about the OZeWAI PAL</a>, how we can improve it and how vendors can update their
                        information.</li>

                </ul>

                <p>Disclaimer:</p>
<ul>
    <li>PAL is best used at the Market Scan phase of the Procurement process.</li>
<li>PAL is designed to offer an initial comparison and is not intended to replace a more detailed assessment of product accessibility during the procurement process.</li>
<li>A PAL score may be out of date with a product’s latest ACR.</li>
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
                                <!-- Row 1 -->
                                <th>Vendor</th>

                                <!-- Row 2 -->
                                <th>Product</th>

                                <!-- Row 3 -->
                                <th>PAL Risk Rating</th>

                                <!-- Row 4 -->
                                <th>Category</th>

                                <!-- Row 5 -->
                                <th>Accessible Percent</th>

                                <!-- Row 6 -->
                                <th>WCAG A</th>

                                <!-- Row 7 -->
                                <th>WCAG AA</th>

                                <!-- Row 8 -->
                                <th>Accessibility Statement</th>

                                <!-- Row 9 -->
                                <th>Accessibility Conformance Report (ACR)</th>

                                <!-- Row 10 -->
                                <!-- <th>VPAT details</th> -->


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jsonData = file_get_contents('https://raw.githubusercontent.com/sitrobotsit/ConformanceScoring/main/conformance-scoring/conformance-data.json');
                            $data = json_decode($jsonData, true);

                            foreach ($data as $row) {
                                echo "<tr>";

                                // ROW 1
                                echo "<td><a href='" . htmlspecialchars($row['Vendor URL']) . "'>" . htmlspecialchars($row['Vendor']) . "</a></td>";

                                // ROW 2
                                // Check if Product URL has data
                                if ($row['Product URL']) {
                                    echo "<td><a href='" . htmlspecialchars($row['Product URL']) . "'>" .
                                        htmlspecialchars($row['Product']) . "</a></td>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Product']) . "</td>";
                                }

                                // ROW 3
                                echo "<td>" . htmlspecialchars($row['PAL Risk Rating']) . "</td>";

                                // ROW 4
                                echo "<td>" . htmlspecialchars($row['Category']) . "</td>";

                                // ROW 5
                                echo "<td>" . htmlspecialchars($row['Accessible Percent'] * 100) . "%</td>";

                                // ROW 6
                                echo "<td>" . htmlspecialchars($row['WCAG A']) . "</td>";

                                // ROW 7
                                echo "<td>" . htmlspecialchars($row['WCAG AA']) . "</td>";

                                // ROW 8
                                // Check if Accessibility Statement data starts with "http"
                                if (strpos($row['Accessibility Statement'], 'http') === 0) {
                                    echo "<td><a href='" . htmlspecialchars($row['Accessibility Statement']) . "'>" . htmlspecialchars($row['Product']) . " Accessibility Statement</a></td>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Accessibility Statement']) . "</td>";
                                }

                                // ROW 9
                                // Check if ACR data starts with "http"
                                if (strpos($row['Accessibility Conformance Report (ACR)'], 'http') === 0) {
                                    echo "<td><a href='" . htmlspecialchars($row['Accessibility Conformance Report (ACR)']) . "'>" . htmlspecialchars($row['Product']) . " Accessibility Conformance Report (ACR)</a></td>";
                                } else {
                                    echo "<td>" . htmlspecialchars($row['Accessibility Conformance Report (ACR)']) . "</td>";
                                }

                                // ROW 10
                                // echo "<td>" . htmlspecialchars($row['VPAT details']) . "</td>";
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
