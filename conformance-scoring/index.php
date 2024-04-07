<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conformance Scoring</title>
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
                <h1>Conformance Scoring</h1>

                <div class="nsw-form">


                    <div class="nsw-form__group">
                        <label class="nsw-form__label" for="categoryFilter">Filter by Category:</label>
                        <select class="nsw-form__select" id="categoryFilter" onchange="filterTable()"
                            class="nsw-form-select">
                            <option value="All">All</option>
                            <?php
                            $jsonData = file_get_contents('conformance-data.json');
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
                                <th>Score</th>
                                <th>Category</th>
                                <th>WCAG Errors</th>
                                <th>WCAG Version</th>
                                <th>VPAT version</th>
                                <th>Software version</th>
                                <th>VPAT Date</th>
                                <th>Accessibility Statement</th>
                                <th>ACR</th>
                                <th>VPAT</th>
                                <th>Author</th>
                                <th>Roadmap</th>
                                <th>Support</th>
                                <th>Issues/bug tracking</th>
                                <th>Caveat</th>

                                <th>Vendor comment</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $jsonData = file_get_contents('conformance-data.json');
                            $data = json_decode($jsonData, true);

                            foreach ($data as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['Vendor']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Product']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Score']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Category']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['WCAG Errors']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['WCAG Version']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['VPAT Version']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Software Version']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['VPAT Date']) . "</td>";
                                echo "<td><a href='" . htmlspecialchars($row['Accessibility Statement']) . "'>Link</a></td>";
                                echo "<td>" . htmlspecialchars($row['ACR']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['VPAT']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Author']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Roadmap']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Support']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Issues\/bug tracking']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['Caveat']) . "</td>";




                                echo "<td>" . htmlspecialchars($row['Vendor comment']) . "</td>";

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