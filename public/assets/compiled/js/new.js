// Preloader: Menghilangkan preloader setelah halaman selesai dimuat
$(window).on("load", function () {
    $(".preloader").fadeOut("slow");
});

// Dark Mode Toggle: Menginisialisasi dark mode dan menyimpan preferensi pengguna di local storage
document.addEventListener('DOMContentLoaded', function() {
    const currentTheme = localStorage.getItem("theme");
    if (currentTheme === "dark") {
        document.body.classList.add("dark-mode");
    }

    const toggle = document.querySelector("#darkModeToggle");
    if (toggle) {
        toggle.addEventListener("click", function() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
        });
    }
});

// Konfirmasi Hapus: Menampilkan konfirmasi sebelum menghapus item
function confirmDelete(  entityId) {
    Swal.fire({
        title: "Apakah Anda yakin ingin menghapus ini?",
        text: "Pilih 'Iya' untuk menghapus atau 'Tidak' untuk membatalkan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak"
    }).then((result) => {
        if (result.isConfirmed) {
            // Men-submit form yang sesuai dengan ID yang diberikan
            document.getElementById('delete-form-' + entityId).submit();
        }
    });
}

// Notifikasi: Menginisialisasi toastr untuk menampilkan notifikasi
$(document).ready(function() {
    if (typeof successMessage !== 'undefined') {
        toastr.success(successMessage);
    }

    if (typeof errorMessage !== 'undefined') {
        toastr.error(errorMessage);
    }
});

// Inisialisasi ApexCharts dan Chart.js
$(document).ready(function() {
    // Inisialisasi ApexCharts
    if (typeof ApexCharts !== 'undefined') {
        var chartOptions = {
            chart: {
                type: 'line',
                height: 350
            },
            series: [{
                name: 'Data Series',
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
            }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
        chart.render();
    }

    // Inisialisasi Chart.js
    if (typeof Chart !== 'undefined') {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});

// Inisialisasi PerfectScrollbar hanya jika elemen terkait ada
document.addEventListener('DOMContentLoaded', function() {
    if (typeof PerfectScrollbar !== 'undefined') {
        const scrollableDiv = document.querySelector('.scrollable-div');
        if (scrollableDiv) {
            new PerfectScrollbar(scrollableDiv);
        }
    }
});
