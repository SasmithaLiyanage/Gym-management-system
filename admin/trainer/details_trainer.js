
document.addEventListener('DOMContentLoaded', function () {
    const model = document.getElementById('modelclass2');
    const tcloseBtn = document.getElementById('tcloseBtn');
    const detailsBtns = document.querySelectorAll('.tdetails-btn');

    detailsBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            // trainer details
            document.getElementById('trainerName').innerText = btn.dataset.trainerName || '';
            document.getElementById('trainerMail').innerText = btn.dataset.trainerMail || '';
            document.getElementById('trainerQualification').innerText = btn.dataset.trainerQualification || '';
            document.getElementById('trainerPhone').innerText = btn.dataset.trainerPhone || '';
            document.getElementById('trainerAddress').innerText = btn.dataset.trainerAddress || '';    



            // Set Edit button href
            var editBtn = document.getElementById('editTrainerBtn');
            
             
            if (editBtn) {
                editBtn.href = '/gym-management-system/admin/trainer/edit_trainer.php?id=' + encodeURIComponent(btn.dataset.id);
                
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