<?php 
namespace YusrilHs\ChartJsHelper;

use YusrilHs\ChartJsHelper\ChartJsLib;
use InvalidArgumentException;

class ChartJsHelper {

    /**
     * Allowed ChartType
     * @var array
     */
    private static $allowedChartType = array(
        'bar',
        'doughnut',
        'line',
        'pie',
        'polarArea',
        'radar',
        'bubble',
        'scatter'
    );

    /**
     * ChartType Builder
     * @param  string $chartType 
     * @return YusrilHs\ChartJsHelper\AbstractChartType            
     */
    public static function createChart($chartType) {
        if (!in_array($chartType, self::$allowedChartType)) {
            throw new InvalidArgumentException(sprintf('Chart %s is not defined', $chartType));
        }

        return new ChartJsLib($chartType);
    }

}
