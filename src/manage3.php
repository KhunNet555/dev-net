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
    <div class="w-full box-border mx-auto">
        <div class="bg-red-300 h-[50px]">navbar</div>
        <div class="flex justify-start">
            <div class="bg-green-100 w-[230px] h-screen">menu</div>
            <div class="flex flex-col w-full">
                <div class="flex flex-col w-full px-10 py-8 gap-y-5">
                    <div class="text-2xl font-semiblod">ระบบ จัดการภาพสไลด์</div>
                    <div class="flex justify-end items-center bg-yellow-50 gap-x-5">
                        <div>refresh</div>
                        <div>save</div>
                        <input type="checkbox" id="selectAllCheckbox"></input>
                        <label for="selectAllCheckbox">เลือกทั้งหมด</label>
                        <button type="button">delete</button>
                    </div>
                </div>
                <table data-hw="hw">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>เลื่อน</th>
                            <th>รูป</th>
                            <th>link</th>
                            <th>วันที่</th>
                            <th>แก้ไข</th>
                            <th>ลบ</th>
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

                // edit
                const editCell = document.createElement("td");
                editCell.innerHTML = "info";

                trCell.appendChild(editCell);

                // delete
                const delCell = document.createElement("td");
                const checkCell = document.createElement("input");

                checkCell.type = "checkbox";

                trCell.appendChild(delCell);
                delCell.appendChild(checkCell);

                // delCell.innerHTML = "info";
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