<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dev-Net</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Sarabun', sans-serif;
    }
</style>

<body>
    <div class="flex flex-col h-screen">
        <div class="bg-red-300 h-[50px] text-center">navbar</div>
        <div class="flex flex-1 justify-center">
            <div class="bg-red-100 w-52">mn</div>
            <div>
                <table data-hw="hw">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ลำดับ</th>
                            <th>รูป</th>
                            <th>link</th>
                            <th>วันที่</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th>add data + pagination</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <script>
        const dataTable = document.querySelector(`[data-hw="hw"]`);
        const dataBody = document.querySelector("tbody");

        function dataTable2(info) {
            console.log(info);
            console.log(info.length);
            for (let i = 0; i < info.length; i++) {
                const trCell = document.createElement("tr");
                dataBody.appendChild(trCell);

                // id
                const idCell = document.createElement("td");
                idCell.textContent = info[i].id;

                trCell.appendChild(idCell);

                // sequent
                const sequentCell = document.createElement("td");
                sequentCell.textContent = info[i].sequent;

                trCell.appendChild(sequentCell);

                // img
                const imgCell = document.createElement("td");
                imgCell.textContent = info[i].filename;

                trCell.appendChild(imgCell);

                // link
                const linkCell = document.createElement("td");
                linkCell.textContent = info[i].link;

                trCell.appendChild(linkCell);

                // dateAdd
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
                    dataTable2(data.data.info);
                })
                .catch(error => {
                    console.log(error);
                })
        }
        fetchData();
    </script>
</body>

</html>