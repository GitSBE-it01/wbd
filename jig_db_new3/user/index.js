/*===================================================================================
initial load
===================================================================================*/
document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/jig_db_new/user';
    const extractedPortion = currentUrl.substring(0,specificUrls.length);
    if (extractedPortion == specificUrls){
        document.getElementById("loading").style.display="block";
        try {
            let result = await fetchData('access');
            let result2 = await fetchData('user');
            
            const datalist = document.getElementById('userList');
            for (let i=0; i<result2.length; i++) {
                const option = document.createElement('option');
                option.value = result2[i].Absensi;
                option.innerText = result2[i].Absensi;
                datalist.appendChild(option);
            }

            const container = document.getElementById('user');
            let header = `<h1>User List</h1>`
            let inputData = `
            <form method="POST">
                <div class='columnView'>
                    <div class="side">                      
                        <div class="card1"><label>Pick User</label></div>
                        <input type="text" class="card2" name="userInput" id="userInput" value='' list='userList' autocomplete="off" >
                    </div>
                    <div class="side">                      
                        <div class="card1"><label>Role</label></div>
                        <input type="text" class="card2" name="role" id="role" value='' list='roleList' autocomplete="off" >
                    </div>
                    <button class="button-30" type="submit" id="userRole" name="userRole">submit</button>
                </div>
            </form>`;

            const table = document.createElement('div');
            const tbody = document.createElement('div');
            let theadData = `
            <div class='tableFlex'>           
                <div class='tableData tableHeader'>User</div>
                <div class='tableData tableHeader'>Role</div>
                <div class='tableData tableHeader'>submit</div>
            </div>

            `;

            let tvalueData = "";
            for (let i=0; i<result.length; i++) {
                 tvalueData += `
                 <form method="POST">
                    <div class='tableFlex'>           
                        <div class='tableData'>
                        <input type="text" id="userChoose" name="userChoose" value ="${result[i].user}"></div>
                        <div class='tableData'>
                        <input type="text" id="newRole" name="newRole" value ="${result[i].role}" list="roleList2"></div>
                        <div class='tableData'>
                        <button type="submit" id="changeRole" name="changeRole">submit</button></div>
                    </div>
                </form>
                `;
            }
            
            const totalHTML = header + inputData + theadData + tvalueData;
            tbody.innerHTML = totalHTML;
            table.appendChild(tbody);
            container.appendChild(table);
            document.getElementById("loading").style.display="none";
        }catch (error) {
            console.log('error :', error);
        }
}
})
