
document.addEventListener('DOMContentLoaded', function () {
    const model = document.getElementById('modelclass');
    const closeBtn = document.getElementById('closeBtn');
    const detailsBtns = document.querySelectorAll('.details-btn');

    detailsBtns.forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            // member detilas
            document.getElementById('memberName').innerText = btn.dataset.name || '';
            document.getElementById('memberUsername').innerText = btn.dataset.username || '';
            document.getElementById('memberMail').innerText = btn.dataset.mail || '';
            document.getElementById('memberPackage').innerText = btn.dataset.package || '';
            document.getElementById('memberPhone').innerText = btn.dataset.phone || '';
            document.getElementById('memberPassword').innerText = btn.dataset.password || '';
            document.getElementById('memberMedicalCheck').innerText = btn.dataset.medical-check || '';
            document.getElementById('memberBudget').innerText = btn.dataset.budget || '';
            document.getElementById('memberExperience').innerText = btn.dataset.experience || '';
            document.getElementById('memberHeight').innerText = btn.dataset.height || '';
            document.getElementById('memberWeight').innerText = btn.dataset.weight || '';
            document.getElementById('memberFitnessGoal').innerText = btn.dataset.fitnessGoal || '';
            document.getElementById('memberAddress').innerText = btn.dataset.address || '';;
         



            // Set Edit button href
            var editBtn = document.getElementById('editMemberBtn');
            
             
            if (editBtn) {
                editBtn.href = '/gym-management-system/admin/member/edit_member.php?id=' + encodeURIComponent(btn.dataset.id);
                
            }
            model.style.display = 'flex';
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            model.style.display = 'none';
        });
    }
});