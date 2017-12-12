<?php
use dosamigos\chartjs\ChartJs;

?>
<div class="comments-chart">
<?= $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">
    <div class="col-sm-6">
    <?= ChartJs::widget([
    'type' => 'bar',
    
    'clientOptions' => [
        'scales' => [
            'yAxes' => [
                [
                    'ticks'=> [
                        'beginAtZero' => true
                    ]
                ]
            ]
        ]
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => "My First dataset",
                'scaleStartValue' => 0, 
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => $data
            ]
        ]
    ]
]);
?>
    </div>
</div>


</div>
