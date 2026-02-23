
document.addEventListener('DOMContentLoaded', function () {
    const model = document.getElementById('modelclass3');
    const tcloseBtn = document.getElementById('acloseBtn');
    const detailsBtns = document.querySelectorAll('.adetails-btn');

    detailsBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // admin details
            document.getElementById('adminUsername').innerText = btn.dataset.adminUserName || '';
            document.getElementById('adminMail').innerText = btn.dataset.adminMail || '';
            document.getElementById('adminRole').innerText = btn.dataset.adminRole || '';



            // Set Edit button href
            var editBtn = document.getElementById('editAdminBtn');
            
             
            if (editBtn) {
                editBtn.href = '/gym-management-system/admin/admin/edit_admin.php?id=' + encodeURIComponent(btn.dataset.id);
                
            }
            model.style.display = 'flex';
        });
    });

    if (tcloseBtn) {
        tcloseBtn.addEventListener('click', function () {
            model.style.display = 'none';
        });
    }
});