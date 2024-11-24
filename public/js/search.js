function filterTable() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.getElementById('TableRow');
    let rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        let row = rows[i];
        let cin = row.cells[0].innerText.toLowerCase();  // CIN
        let nom = row.cells[1].innerText.toLowerCase();  // Nom
        let prenom = row.cells[2].innerText.toLowerCase();  // Prenom
        let email = row.cells[3].innerText.toLowerCase();
        let phone = row.cells[4].innerText;

        if (cin.includes(filter) || nom.includes(filter) || prenom.includes(filter)||phone.includes(filter)||email.includes(filter)) {
            row.style.display = '';  
        } else {
            row.style.display = 'none';  
        }
    }}