<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <table data-tb="tb">
        <thead>
            <tr>
                <th>id</th>
                <th>sequent</th>
                <th>img</th>
                <th>link</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>add data + pagination</th>
            </tr>
        </tfoot>
    </table>

    <script>
        const myTable = document.querySelector(`[data-tb="tb"]`);
        const myBody = document.querySelector("tbody");

        function netTable(info) {
            console.log(info);
            console.log(info.length);
            for (let i = 0; i < info.length; i++) {

                const trCell = document.createElement("tr");
                myBody.appendChild(trCell);

                //id
                const idCell = document.createElement("td");
                idCell.textContent = info[i].id;

                trCell.appendChild(idCell);

                //sequent
                const sequentCell = document.createElement("td");
                sequentCell.textContent = info[i].sequent;

                trCell.appendChild(sequentCell);

                //img
                const imgCell = document.createElement("td");
                imgCell.textContent = info[i].filename;

                trCell.appendChild(imgCell);

                //link
                const linkCell = document.createElement("td");
                linkCell.textContent = info[i].link;

                trCell.appendChild(linkCell);

                //date
                const dateCell = document.createElement("td");
                dateCell.textContent = info[i].dateAdd;

                trCell.appendChild(dateCell);
            }
        }

        function fetchData() {
            const url = "../api/slide_api.php";
            fetch(url, {
                    method: 'GET',
                    credentials: 'include',
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    netTable(data.data.info);
                })
                .catch(error => {
                    console.log(error);
                })
        }
        fetchData();
    </script>

</body>

</html>