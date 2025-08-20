<?php
session_start();
require __DIR__ . '/../../koneksi/koneksi.php';
$title_web = 'Kalender Booking';

// Cek login dan akses admin
if (empty($_SESSION['USER'])) { 
    header("Location: ../login.php");
    exit;
}
if ($_SESSION['USER']['level'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Ambil data booking yang masih dalam masa sewa
$sql = "SELECT kode_booking, nama, tanggal, lama_sewa, mobil.tipe
        FROM booking 
        JOIN mobil ON booking.id_mobil = mobil.id_mobil
        WHERE DATE(tanggal) <= CURDATE() 
        AND DATE_ADD(tanggal, INTERVAL lama_sewa DAY) >= CURDATE()";
$stmt = $koneksi->prepare($sql);
$stmt->execute();
$hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mapping warna berdasarkan tipe mobil
function warnaBerdasarkanPaket($tipe) {
    $tipe = strtolower(trim($tipe));
    $warna = [
        'avanza all new 24 jam' => '#dc3545',
        'avanza g'              => '#007bff',
        'innova reborn'         => '#28a745',
        'honda br-v dan mobilio' => '#fd7e14',
        'manual'                => '#6c757d',
        'matic'                 => '#ffc107',
        'mobil pengantin'       => '#8e44ad' 
    ];
    return $warna[$tipe] ?? '#343a40';
}

// Konversi ke format event untuk FullCalendar
$events = [];
foreach ($hasil as $row) {
    $start_date = $row['tanggal'];
    $end_date = date('Y-m-d', strtotime($row['tanggal'] . ' + ' . $row['lama_sewa'] . ' days'));

    $events[] = [
        'title' => $row['tipe'] . " - " . $row['nama'],
        'start' => $start_date,
        'end'   => $end_date,
        'color' => warnaBerdasarkanPaket($row['tipe']),
        'extendedProps' => [
            'kode_booking' => $row['kode_booking'],
            'nama' => $row['nama'],
            'tipe' => $row['tipe']
        ]
    ];
}

include '../layouts/sidebar_admin.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../assets/image/Logo Tab Rental Mobil2.png" type="image/x-icon">
    <title><?= $title_web; ?> - THO-KING RENTAL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
        }

        .page-header {
            background: linear-gradient(135deg, #0056b3, #007bff);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 0.5rem;
        }

        #main {
            margin-left: 275px;
            padding: 2rem;
            min-height: 100vh;
        }

        .calendar-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .calendar-header {
            background: #ffffff;
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        #calendar {
            padding: 1.5rem;
            min-height: 600px;
        }

        /* Enhanced FullCalendar Styling */
        .fc {
            font-family: 'Inter', sans-serif;
        }

        .fc-toolbar-title {
            font-size: 1.5rem !important;
            font-weight: 600;
            color: #2563eb;
        }

        .fc-button {
            background: #2563eb !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .fc-button:hover {
            background: #1d4ed8 !important;
            transform: translateY(-1px);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .fc-button-active {
            background: #1d4ed8 !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            font-size: 0.85rem !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        }

        .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
        }

        .fc-event-main {
            color: white !important;
        }

        .fc-day-today {
            background: rgba(37, 99, 235, 0.1) !important;
        }

        .fc-daygrid-day-number {
            color: #2563eb;
            font-weight: 600;
        }

        /* Legend Styles */
        .legend-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .legend-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .legend-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.75rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: #f8fafc;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .legend-item:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-text {
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: #2563eb;
        }

        .stat-content p {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #main {
                margin-left: 0;
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .legend-grid {
                grid-template-columns: 1fr;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div id="main">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-calendar-alt"></i>
            Kalender Masa Sewa
        </h1>
        <p class="page-subtitle">
            Kelola dan pantau semua booking mobil yang sedang berlangsung
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon" style="background: #2563eb;">
                <i class="fas fa-car"></i>
            </div>
            <div class="stat-content">
                <h3><?= count($hasil) ?></h3>
                <p>Total Booking Aktif</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #10b981">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3><?= date('d M Y') ?></h3>
                <p>Tanggal Hari Ini</p>
            </div>
        </div>
    </div>

    <!-- Calendar Container -->
    <div class="calendar-container">
        <div class="calendar-header">
            <h5 class="mb-0">
                <i class="fas fa-calendar-check text-primary"></i>
                Kalender Booking
            </h5>
        </div>
        <div id="calendar">
            <div class="loading">
                <div class="spinner"></div>
                Memuat kalender...
            </div>
        </div>
    </div>

    <!-- Legend -->
    <div class="legend-container">
        <h5 class="legend-title">
            <i class="fas fa-palette"></i>
            Keterangan Warna
        </h5>
        <div class="legend-grid">
            <div class="legend-item">
                <div class="legend-color" style="background: #dc3545;"></div>
                <span class="legend-text">Avanza All New 24 Jam</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #007bff;"></div>
                <span class="legend-text">Avanza G</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #28a745;"></div>
                <span class="legend-text">Innova Reborn</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #fd7e14;"></div>
                <span class="legend-text">Honda BR-V dan Mobilio</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #6c757d;"></div>
                <span class="legend-text">Manual</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #ffc107;"></div>
                <span class="legend-text">Matic</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #8e44ad;"></div>
                <span class="legend-text">Mobil Pengantin</span>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    // Remove loading spinner
    calendarEl.innerHTML = '';

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek'
        },
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week: 'Minggu'
        },
        events: <?= json_encode($events); ?>,
        eventClick: function(info) {
            // Show booking details on click
            alert(`
                Kode Booking: ${info.event.extendedProps.kode_booking}
                Nama: ${info.event.extendedProps.nama}
                Tipe Mobil: ${info.event.extendedProps.tipe}
                Tanggal: ${info.event.start.toLocaleDateString('id-ID')}
                Sampai: ${info.event.end.toLocaleDateString('id-ID')}
            `);
        },
        eventMouseEnter: function(info) {
            info.el.style.cursor = 'pointer';
        },
        dayHeaderFormat: {
            weekday: 'long'
        },
        firstDay: 1,
        slotMinTime: '06:00:00',
        slotMaxTime: '22:00:00'
    });

    calendar.render();
});
</script>
</body>
</html>
