<?php

namespace App\Classes\Converters;

use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExcelConverter
{
    public function __construct(private ?Collection $messages) {}

    public function exec()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('C')->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);

        $border = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '000000')
                ]
            ],
            'allborders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => array('rgb' => '000000')
                ]
            ],
        ];
        $sheet->getStyle('A1:E1')->applyFromArray($border);

        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Имя');
        $sheet->setCellValue('C1', 'Сообщение');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Дата создания');

        $stringKey = 2;
        foreach ($this->messages as $message) {
            $sheet->setCellValue(sprintf('A%d', $stringKey), $message->id);
            $sheet->setCellValue(sprintf('B%d', $stringKey), $message->name);
            $sheet->setCellValue(sprintf('C%d', $stringKey), $message->message);
            $sheet->setCellValue(sprintf('D%d', $stringKey), $message->email);
            $sheet->setCellValue(sprintf('E%d', $stringKey), $message->created_at);
            ++$stringKey;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = sprintf('report_%s.xlsx', date('d-m-Y H:i:s'));
        $writer->save(storage_path($filename));

        $content = file_get_contents(storage_path($filename));

        header("Content-Disposition: attachment; filename=".$filename);

        unlink(storage_path($filename));
        exit($content);
    }
}
