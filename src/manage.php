<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table data-dev="dev">
        <thead>
            <tr>
                <th>No.</th>
                <th>ลำดับ</th>
                <th>รูป</th>
                <th>ลิงค์</th>
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

    <script>
        const myTable = document.querySelector(`[data-dev="dev"]`);
        const myBody = document.querySelector("tbody");

        function dataTable(info) {
            for (let i = 0; i < info.length; i++) {
                const myTr = document.createElement("tr");
                const myTd = document.createElement("td");
                myBody.appendChild(myTr);
                myTr.appendChild(myTd);

                myTd.textContent = info[i].id;

                // ลำดับ
                const myTd2 = document.createElement("td");
                myTr.appendChild(myTd2);

                myTd2.textContent = info[i].sequent;

                // รูป
                const myTd3 = document.createElement("td");
                myTr.appendChild(myTd3);

                myTd3.textContent = info[i].filename;

                // ลิงค์
                const myTd4 = document.createElement("td");
                myTr.appendChild(myTd4);

                myTd4.textContent = info[i].link;

                // วันที่
                const myTd5 = document.createElement("td");
                myTr.appendChild(myTd5);

                myTd5.textContent = info[i].dateAdd;
            }
        }

        function fetchData() {
            const url = "../api/slide_api.php";
            fetch(url, {
                    method: 'POST',
                    credentials: 'include',
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    dataTable(data.data.info);
                })
                .catch(error => {
                    console.log(error);
                })
        }
        fetchData();
    </script>
</body>

</html>