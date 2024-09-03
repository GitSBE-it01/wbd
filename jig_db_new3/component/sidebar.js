export const createSidebar = (target, color) => {
    const container = document.getElementById(target);
    const roleUser = document.getElementById('role').value;
    const createSidebar = document.createElement('div');

    const check = window.location.href.split("/");
    let url ="";
    if (check[2].length > 20 ){
        url = 'http://informationsystem.sbe.co.id:8080';
    } else {
        url = 'http://192.168.2.103:8080';
    }
    
    if (roleUser === 'superuser') {
    createSidebar.innerHTML = `
    <div class="sideCard sidebar ${color}">
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/index.php"><span class="fc-w">Home</span></a></div>
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/update/"><span class="fc-w">Update Data & Stock</span></a></div>
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/transaksi/"><span class="fc-w">Transaction</span></a></div>
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/usage/"><span class="fc-w">Usage</span></a></div>
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/add_data/"><span class="fc-w">Add New</span></a></div>
        <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/user/"><span class="fc-w">User</span></a></div>
        <div class="m3 hv-fw-blk scale-120"><a data-nav class="text-undecor" href="${url}/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
    </div>
    `;
    container.appendChild(createSidebar);
    return createSidebar;
    } 

    if (roleUser === 'admin') {
        createSidebar.innerHTML = `
        <div class="sideCard sidebar ${color}">
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/index.php"><span class="fc-w">Home</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/update/"><span class="fc-w">Update Data & Stock</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/transaksi/"><span class="fc-w">Transaction</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/usage/"><span class="fc-w">Usage</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/add_data/"><span class="fc-w">Add New</span></a></div>
            <div class="m3 hv-fw-blk scale-120"><a data-nav class="text-undecor" href="${url}/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
        </div>
        `;
        container.appendChild(createSidebar);
        return createSidebar;
        } 

    createSidebar.innerHTML = `
        <div class="sideCard sidebar ${color}">
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/index.php"><span class="fc-w">Home</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/transaksi/"><span class="fc-w">Transaction</span></a></div>
            <div class="m3 hv-fw-blk hv-fs-l"><a data-nav class="text-undecor" href="${url}/wbd/jig_db_new/usage/"><span class="fc-w">Usage</span></a></div>
            <div class="m3 hv-fw-blk scale-120"><a data-nav class="text-undecor" href="${url}/sbe/index.php?cek=no"><button type="button" class="home2"></button></a></div>
        </div>
        `; 
    container.appendChild(createSidebar);
    return createSidebar;
}

export const activeLink = (target) => {
    const aLink = document.querySelectorAll(target);
    const currentUrl = window.location.href;
    aLink.forEach(link=> {
        const hrefValue = link.getAttribute('href'); 
        const span = link.querySelector('span.fc-w');
        if (hrefValue === currentUrl) {
            span.classList.add('active'); // Add the new class if it matches
    }   
})}
