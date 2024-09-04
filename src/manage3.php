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
                        <button data-button-delete="all" type="button" class="hidden">delete</button>
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
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const deleteButton = document.querySelector(`[data-button-delete="all"]`);

        function dataTable2(info) {
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

                // กำหนดค่าให้ Attribute
                checkCell.setAttribute("data-delete", info[i].id)

                trCell.appendChild(delCell);
                delCell.appendChild(checkCell);
            }
        }

        deleteButton.addEventListener("click", function() {
            const checkboxes = document.querySelectorAll(`[data-delete]`);
            let deleteList = [];

            checkboxes.forEach(checkbox => {
                if (checkbox.checked == true) {
                    console.log(checkbox.getAttribute("data-delete"));
                    deleteList.push(checkbox.getAttribute("data-delete"))
                }
            });
            deleteData(deleteList);

        })

        function deleteData(list) {
            console.log(list);

            const myData = new FormData()
            const type = "slide";

            myData.append("listID", list)
            myData.append("type", type)

            const url = "../api/remove_api.php";

            fetch(url, {
                    method: 'POST',
                    credentials: 'include',
                    body: myData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                })
        }

        // อัพเดท checkbox
        function updateCheckboxes(checked) {
            const checkboxes = dataBody.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = checked;
                if (checked == true) {
                    deleteButton.classList.remove("hidden");
                }
            });
        }

        selectAllCheckbox.addEventListener('change', function() {
            updateCheckboxes(selectAllCheckbox.checked);
        });

        window.addEventListener("change", function() {
            toggleDeleteButton();
        })

        // check status ทั้งหมด
        function toggleDeleteButton() {
            const checkboxes = document.querySelectorAll("[data-delete]");

            let isAnyChecked = false;

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("click", function() {
                    console.log(checkbox.checked);
                    if (checkbox.checked == false) {
                        selectAllCheckbox.checked = false
                    }
                });
                if (checkbox.checked) {
                    isAnyChecked = true;
                }
            });
            if (isAnyChecked == true) {
                // โชว์
                deleteButton.classList.remove("hidden")
            } else {
                // ซ่อน
                deleteButton.classList.add("hidden");
            }
            console.log(isAnyChecked);
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