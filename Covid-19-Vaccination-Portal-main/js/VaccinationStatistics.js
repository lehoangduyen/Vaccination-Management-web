var xValues = ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"];

// Chart-2
var ctx2 = document.getElementById('myChart-2').getContext('2d');
var myChart2 = new Chart(ctx2, {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [
            {
                data: [1000,1233,2345,234,2342,5345,3234,542,234,3423,523,132],
                borderColor: "rgb(220,222,224)"
            }
        ]
    },
    options: {
        legend: {display: false}
    }   
});

//Chart-3 
// var ctx3 = document.getElementById('myChart-3').getContext('2d');
// var myChart2 = new Chart(ctx3, {
// type: "bar",
// data: {
//     labels: xValues,
//     datasets: [{ 
//     data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
//     borderColor: "red",
//     // fill: false
//     }]
//  },
// options: {
//     legend: {display: false}
    
// }
// });


// Chart-1
// var ctx1 = document.getElementById('myChart-1').getContext('2d');
// var myChart1 = new Chart(ctx1, {
// type: "line",
// data: {
//     labels: xValues,
//     datasets: [{ 
//     data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
//     borderColor: "red",
//     // fill: false
//     }, { 
//      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,9000],
//     borderColor: "green",
//     // fill: false
//     }, { 
//     data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
//     borderColor: "blue",
//     // fill: false
//     }]
//  },
// options: {
//     legend: {display: false}
    
// }
// });

// Chart-0
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
type: "line",
data: {
    labels: xValues,
    datasets: [{ 
    label: 'Số ca bình phục',
    data: [67230,43780,44780,49300,52100,39300,27100,17700,9600,8600,14090,18600],
    borderColor: "green",
    // fill: false
    }, { 
    label: 'Số ca nhiễm',
     data: [97830,89430,80000,65210,57320,49710,27220,20120,19840,17210,17220,16640],
    borderColor: "blue",
    // fill: false
    }, { 
    label: 'Số ca tử vong',
    data: [8253,6874,7090,3000,2000,3750,4300,4300,3650,3010,2830,4450],
    borderColor: "red",
    // fill: false
    }]
 },
options: {
    legend: {display: false}
    
}
});


$(document).ready(function () {

    // LOAD FRONT END DATA
    menu_title = '<a href="VaccinationStatistics.php">Thống kê số liệu tiêm chủng</a>'
    $('#function-navigation-bar-title').html(menu_title)

    homepage = '<a href="HomepageORG.php">Trang chủ</a>'
    $('#homepage-path').html(homepage)

    subpage = '<a href="VaccinationStatistics.php">Thống kê</a>'
    $('#subpage-path').html(subpage)

    selected_function = '<a href="VaccinationStatistics.php">Thống kê số liệu tiêm chủng</a>'
    $('#selected-function-path').html(selected_function)
    // END LOAD FRONT END DATA

    // HANDLE LOAD DATA
    

    // Handle Button
    $('#btn-filter-schedule').click(function () {
    
        //Lay ngay bat dau va ket thuc
        start_date = $('#start-date').val()
        end_date = $('#end-date').val()
        console.log(start_date);
        console.log(end_date);

        console.log('Test');
        $('canvas#myChart').remove();
        $('#dvChart').html('<canvas id="myChart"style="width:100%;max-width:500px; display:inline; align-items: center;margin-left: 28px;margin-right: 50px" class="chartjs-render-monitor"></canvas>');
        console.log('T Á O');
        

        // $('.holder-function-panel .function-panel').html(aaa);
        // console.log('Bước 1')
        // $.ajax({
        //     url:'VaccinationStatistics.php',
        //     method:"post",
        //     Type: "JSON",
        //     data:{xValues:'Tháng 2'},

        //     success:function(data1)
        //     {
        //         console.log('kiểm tra biểu đồ');
        //         myChart.setData(data);
        //         console.log(data);
        //     },

        //     error:function(error){
        //         console.log('Đm lỗi rồi ba');
        //         console.log(error)
        //     }
        // })
        // console.log('Kết thúc ajax');

        var xValues = ["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"];

        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
        type: "line",
        data: {
        labels: xValues,
        datasets: [{ 
        data: [860,1140,1060,1060,1070,1110,1330,2210,7830,3000,1000,2000],
        borderColor: "red",
        // fill: false
        }, { 
        data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,3000,1000,2000],
        borderColor: "green",
        // fill: false
        }, { 
        data: [300,700,2000,5000,6000,4000,2000,1000,200,100,1000,2000],
        borderColor: "blue",
        // fill: false
    }]
 },
options: {
    legend: {display: false}
    
}
});



        
        })
    
})



