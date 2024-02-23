export const createSidebar = (target, color) => {
    const container = document.getElementById(target);
    const roleUser = document.getElementById('role').value;
    const createSidebar = document.createElement('div');

    const check = window.location.href.split("/");
    let url ="";
    if (check[2].length > 20 ){
        url = 'http://informationsystem.sbe.co.id:8080/wbd/jig_db_new/';
    } else {
        url = 'http://192.168.2.103:8080/wbd/jig_db_new/';
    }
    
    if (roleUser === 'superuser') {
    createSidebar.innerHTML = `
    <div class="sideCard sidebar ${color}">
        <div class="sideli"><a class="link" href="${url}index.php"><span class="fc-w">Home</span></a></div>
        <div class="sideli"><a class="link" href="${url}update/"><span class="fc-w">Update Data & Stock</span></a></div>
        <div class="sideli"><a class="link" href="${url}transaksi/"><span class="fc-w">Transaction</span></a></div>
        <div class="sideli"><a class="link" href="${url}usage/"><span class="fc-w">Usage</span></a></div>
        <div class="sideli"><a class="link" href="${url}add_data/"><span class="fc-w">Add New</span></a></div>
        <div class="sideli"><a class="link" href="${url}user/"><span class="fc-w">User</span></a></div>
        <div class="sideli"><a class="link" href="http://192.168.2.103:8080/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
    </div>
    `;
    container.appendChild(createSidebar);
    return createSidebar;
    } 

    if (roleUser === 'admin') {
        createSidebar.innerHTML = `
        <div class="sideCard sidebar ${color}">
            <div class="sideli"><a class="link" href="${url}index.php"><span class="fc-w">Home</span></a></div>
            <div class="sideli"><a class="link" href="${url}update/"><span class="fc-w">Update Data & Stock</span></a></div>
            <div class="sideli"><a class="link" href="${url}transaksi/"><span class="fc-w">Transaction</span></a></div>
            <div class="sideli"><a class="link" href="${url}usage/"><span class="fc-w">Usage</span></a></div>
            <div class="sideli"><a class="link" href="${url}add_data/"><span class="fc-w">Add New</span></a></div>
            <div class="sideli"><a class="link" href="http://192.168.2.103:8080/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
        </div>
        `;
        container.appendChild(createSidebar);
        return createSidebar;
        } 

    createSidebar.innerHTML = `
        <div class="sideCard sidebar ${color}">
            <div class="sideli"><a class="link" href="${url}index.php"><span class="fc-w">Home</span></a></div>
            <div class="sideli"><a class="link" href="${url}transaksi/"><span class="fc-w">Transaction</span></a></div>
            <div class="sideli"><a class="link" href="${url}usage/"><span class="fc-w">Usage</span></a></div>
            <div class="sideli"><a class="link" href="http://192.168.2.103:8080/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
        </div>
        `; 
    container.appendChild(createSidebar);
    return createSidebar;
}

export const activeLink = (target) => {
    const aLink = document.querySelectorAll(target);
    aLink.forEach(link=> {
        const currentUrl = window.location.href;
        const hrefValue = link.getAttribute('href'); 
        const span = link.querySelector('span.fc-w');
        if (hrefValue === currentUrl) {
            span.classList.add('active'); // Add the new class if it matches
    }   
})}
