// استمع لكل زر عليه كلاس delete-button
document.querySelectorAll('.delete-button').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // منع الانتقال مباشرة

        const link = this.getAttribute('href'); // أخذ الرابط اللي بيحذف

        Swal.fire({
            title: "هل أنت متأكد أنك تريد حذف هذا الطبق؟",
            showCancelButton: true,
            confirmButtonText: "تأكيد",
            cancelButtonText: "إلغاء",
            confirmButtonColor: '#d33',
            customClass: {
                confirmButton: 'no-outline',
                cancelButton: 'no-outline'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // بعد الحذف، يظهر تأكيد آخر
                Swal.fire({
                    title: 'تم حذف الطبق بنجاح',
                    icon: 'success',
                    confirmButtonText: 'موافق',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // بعد أن يضغط المستخدم "موافق"، يذهب إلى الرابط
                    window.location.href = link;
                });
            }
        });
    });
});

// استمع لكل زر عليه كلاس delete-button-cat
document.querySelectorAll('.delete-button-cat').forEach(function(button) {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // منع الانتقال مباشرة

        const link = this.getAttribute('href'); // أخذ الرابط اللي بيحذف

        Swal.fire({
            title: "هل أنت متأكد أنك تريد حذف هذي الفئة؟",
            html: "<span style='color: #b80000; font-weight: bold;'>سيتم حذف كل الأصناف المرتبطة بهذه الفئة ولا يمكن استرجاعها!</span>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "تأكيد",
            cancelButtonText: "إلغاء",
            confirmButtonColor: '#d33',
            customClass: {
                confirmButton: 'no-outline',
                cancelButton: 'no-outline'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // بعد الحذف، يظهر تأكيد آخر
                Swal.fire({
                    title: 'تم حذف الفئة بنجاح',
                    icon: 'success',
                    confirmButtonText: 'موافق',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    // بعد أن يضغط المستخدم "موافق"، يذهب إلى الرابط
                    window.location.href = link;
                });
            }
        });
    });
});



document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const filter = btn.dataset.filter;

        // فلترة الأطباق بناءً على فئة الفئة المحددة
        document.querySelectorAll('.menu-card').forEach(card => {
            const cardCategory = card.dataset.categoryId; // الحصول على الـ category_id من الداتا أتيبيوت

            if (filter === 'all' || cardCategory == filter) {
                card.style.display = 'block'; // إظهار الطبق
            } else {
                card.style.display = 'none'; // إخفاء الطبق
            }
        });

        // تحديث زر الفلتر النشط
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    });
});