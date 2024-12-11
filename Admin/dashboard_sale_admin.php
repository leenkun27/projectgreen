<?php include '../condb.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f4f9;
            font-family: Arial, sans-serif;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h4 {
            color: #6c757d;
        }

        .card .value {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }

        .chart-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .btn-download {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php include '../header_admin.php'; ?>
        <div class="row">
            <div class="col-2">
                <?php include '../menu_admin.php'; ?>
            </div>
            <div class="card mt-3 pb-5 px-2 col-10">
                <div class="col-12">
                    <h2>ยอดขายวันนี้</h2>
                </div>

                <!-- ข้อมูลสรุป -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card p-2">
                            <h4>ยอดรวม</h4>
                            <p class="value">฿</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2">
                            <h4>การเติบโต</h4>
                            <p class="value text-success">0%</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2">
                            <h4>บิลยกเลิก</h4>
                            <p class="value text-danger">0</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-2">
                            <h4>เฉลี่ย/บิล</h4>
                            <p class="value">฿</p>
                        </div>
                    </div>
                </div>

                <!-- กราฟ -->
                <div class="chart-container mt-5">
                    <h4>ช่วงเวลา (24 ชั่วโมง)</h4>
                    <canvas id="salesChart"></canvas>
                    <!-- <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-download me-2"><i class="bi bi-download"></i> ดาวน์โหลดกราฟ</button>
                            <button class="btn btn-download"><i class="bi bi-graph-up"></i> แสดงรายงาน</button>
                        </div> -->
                </div>


                <div class="card mt-3 pb-5 px-2 col-10">
                    <div class="col-12">
                        <div class="chart-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><i class="bi bi-star-fill text-warning"></i> สินค้า ขายดี 5 อันดับ</h4>
                                <div>
                                    <button class="btn btn-download me-2"><i class="bi bi-download"></i></button>
                                    <button class="btn btn-download"><i class="bi bi-bar-chart"></i></button>
                                </div>
                            </div>

                            
                            <canvas id="topProductsChart"></canvas>
                            <div class="legend mt-3">
                                <!-- <?php foreach ($top_products as $index => $product) : ?>
                                <div class="legend-item">
                                    <div class="legend-color" style="background-color: <?php echo ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'][$index]; ?>;"></div>
                                    <span><?php echo $product; ?>: ฿<?php echo number_format($prices[$index], 2); ?> (<?php echo number_format(($quantities[$index] / array_sum($quantities)) * 100, 2); ?>%)</span>
                                </div>
                            <?php endforeach; ?> -->
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // ข้อมูลจาก PHP
                    const labels = <?php echo json_encode($top_products); ?>;
                    const data = <?php echo json_encode($quantities); ?>;

                    // ตั้งค่ากราฟ
                //     const ctx = document.getElementById('topProductsChart').getContext('2d');
                //     const topProductsChart = new Chart(ctx, {
                //         type: 'bar',
                //         data: {
                //             labels: labels,
                //             datasets: [{
                //                 label: 'จำนวนที่ขาย',
                //                 data: data,
                //                 backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                //                 borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                //                 borderWidth: 1
                //             }]
                //         },
                //         options: {
                //             responsive: true,
                //             plugins: {
                //                 legend: {
                //                     display: false
                //                 }
                //             },
                //             scales: {
                //                 y: {
                //                     beginAtZero: true,
                //                     title: {
                //                         display: true,
                //                         text: 'จำนวน (ชิ้น)'
                //                     }
                //                 },
                //                 x: {
                //                     title: {
                //                         display: true,
                //                         text: 'สินค้า'
                //                     }
                //                 }
                //             }
                //         }
                //     });
                // </script>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // ข้อมูลกราฟ (ปรับแต่งตามฐานข้อมูล)
                    const chartData = <?php echo json_encode($chart_data); ?>;

                    // ตั้งค่ากราฟ
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                            datasets: [{
                                label: 'ยอดขาย',
                                data: chartData,
                                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                                borderColor: '#007bff',
                                borderWidth: 2,
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'เวลา'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'ยอดขาย (฿)'
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    $(document).ready(function() {
                        $(".cart").click(function() {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "You clicked the button!",
                                icon: "success"
                            });
                        });
                    });
                </script>
</body>

</html>