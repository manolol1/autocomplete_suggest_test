<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>autocomplete/suggestion test</title>
</head>

<body>
    <form>
        <input type="text" id="input" list="suggestions" autocomplete="off">
        <datalist id="suggestions">
            <!-- Suggestions will be inserted here -->
        </datalist>
    </form>

    <script>
        document.getElementById('input').addEventListener('input', function () {
            const inputValue = this.value;

            fetch('search.php?query=' + inputValue, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(suggestions => {
                const dataListElement = document.getElementById('suggestions');
                dataListElement.innerHTML = ''; // Clear existing suggestions
                suggestions.forEach(suggestion => {
                    const option = document.createElement('option');
                    option.value = suggestion;
                    dataListElement.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>