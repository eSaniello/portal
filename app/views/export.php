<?php
require '../../start.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv as CsvWriter;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use Controllers\Datas;
use Controllers\Users;
use Controllers\Audits;

session_start();

$user = Users::get_user_by_id($_SESSION['user_id']);
$data = Datas::get_data_by_uid($_SESSION['user_id']);

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type == "PDF") {
        $msg = "Exported to PDF and sent mail";
        Audits::add_audit($_SESSION['user_id'], $msg);

        $mpdf = new \Mpdf\Mpdf();

        $html =
            "<h1>Data from user: " . $_SESSION['fullname'] . "</h1><hr>
            <table style='width: 100%; border-collapse:collapse; border: 1px solid black;'>
                <thead>
                    <tr>
                    <th style='border:1px solid black'>Number</th>
                    <th style='border:1px solid black'>Code</th>
                    <th style='border:1px solid black'>Start Date</th>
                    <th style='border:1px solid black'>End Date</th>
                    <th style='border:1px solid black'>Num 1</th>
                    <th style='border:1px solid black'>Percent</th>
                    <th style='border:1px solid black'>Num 2</th>
                    <th style='border:1px solid black'>Expiry Date</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($data as $d) {
            $html .= "<tr>";
            $html .= "<td style='border:1px solid black'>" . $d['number'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['code'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['start_date'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['end_date'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['num1'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['percent'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['num2'] . "</td>";
            $html .= "<td style='border:1px solid black'>" . $d['expiry_date'] . "</td>";
            $html .= "</tr>";
        };

        $html .= "</tbody></table>";

        $mpdf->Bookmark('Start of the document');
        $mpdf->WriteHTML($html);

        $mpdf->Output("data.pdf", "F");

        // Email the file as an attachment
        sendMail("data.pdf");
    } elseif ($type == "WORD") {
        $msg = "Exported to WORD and sent mail";
        Audits::add_audit($_SESSION['user_id'], $msg);

        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            "Data from user: " . $_SESSION['fullname'],
            $fontStyleName
        );

        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);

        $table = $section->addTable($fancyTableStyleName);
        $table->addRow();
        $table->addCell(1750)->addText("Number");
        $table->addCell(1750)->addText("Code");
        $table->addCell(1750)->addText("Start Date");
        $table->addCell(1750)->addText("End Date");
        $table->addCell(1750)->addText("Num1");
        $table->addCell(1750)->addText("Percent");
        $table->addCell(1750)->addText("Num2");
        $table->addCell(1750)->addText("Expiry Date");

        foreach ($data as $d) {
            $table->addRow();

            $table->addCell(1750)->addText($d['number']);
            $table->addCell(1750)->addText($d['code']);
            $table->addCell(1750)->addText($d['start_date']);
            $table->addCell(1750)->addText($d['end_date']);
            $table->addCell(1750)->addText($d['num1']);
            $table->addCell(1750)->addText($d['percent']);
            $table->addCell(1750)->addText($d['num2']);
            $table->addCell(1750)->addText($d['expiry_date']);
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('data.docx');

        // Email the file as an attachment
        sendMail("data.docx");
    } elseif ($type == "EXCEL") {
        $msg = "Exported to EXCEL and sent mail";
        Audits::add_audit($_SESSION['user_id'], $msg);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Number')
            ->setCellValue('B1', 'Code')
            ->setCellValue('C1', 'Start Date')
            ->setCellValue('D1', 'End Date')
            ->setCellValue('E1', 'Num1')
            ->setCellValue('F1', 'Percent')
            ->setCellValue('G1', 'Num2')
            ->setCellValue('H1', 'Expiry Date');

        $arr_data = [];
        foreach ($data as $d) {
            $r = [$d['number'], $d['code'], $d['start_date'], $d['end_date'], $d['num1'], $d['percent'], $d['num2'], $d['expiry_date']];
            array_push($arr_data, $r);
        }

        $spreadsheet->getActiveSheet()->fromArray($arr_data, null, 'A2');
        $spreadsheet->getActiveSheet()->setAutoFilter($spreadsheet->getActiveSheet()->calculateWorksheetDimension());

        // Save
        $writer = new Xlsx($spreadsheet);
        $writer->save('data.xlsx');

        // Email the file as an attachment
        sendMail("data.xlsx");
    } elseif ($type == "CSV") {
        $msg = "Exported to CSV and sent mail";
        Audits::add_audit($_SESSION['user_id'], $msg);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Number')
            ->setCellValue('B1', 'Code')
            ->setCellValue('C1', 'Start Date')
            ->setCellValue('D1', 'End Date')
            ->setCellValue('E1', 'Num1')
            ->setCellValue('F1', 'Percent')
            ->setCellValue('G1', 'Num2')
            ->setCellValue('H1', 'Expiry Date');

        $arr_data = [];
        foreach ($data as $d) {
            $r = [$d['number'], $d['code'], $d['start_date'], $d['end_date'], $d['num1'], $d['percent'], $d['num2'], $d['expiry_date']];
            array_push($arr_data, $r);
        }

        $spreadsheet->getActiveSheet()->fromArray($arr_data, null, 'A2');

        $writer = new CsvWriter($spreadsheet);
        $writer->setDelimiter(',')
            ->setEnclosure('"')
            ->setSheetIndex(0);

        $callStartTime = microtime(true);
        $filename = "data.csv";
        $writer->save($filename);

        // Email the file as an attachment
        sendMail("data.csv");
    } elseif ($type == "JSON") {
        $msg = "Exported to JSON and sent mail";
        Audits::add_audit($_SESSION['user_id'], $msg);

        $response = array();
        $jsonData = array();
        foreach ($data as $d) {
            $number = $d['number'];
            $code = $d['code'];
            $startDate = $d['start_date'];
            $endDate = $d['end_date'];
            $num1 = $d['num1'];
            $percent = $d['percent'];
            $num2 = $d['num2'];
            $expiryDate = $d['expiry_date'];

            $jsonData[] = array(
                'number' => $number, 'code' => $code, 'start_date' => $startDate,
                'end_date' => $endDate, 'num1' => $num1, 'percent' => $percent, 'num2' => $num2, 'expiry_date' => $expiryDate
            );
        }

        $response['data'] = $jsonData;

        $fp = fopen('data.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);

        // Email the file as an attachment
        sendMail("data.json");
    }
}

function sendMail($file)
{
    $from = $_POST['from'];
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $mail = new PHPMailer;
    $mail->isSMTP();

    //Enable SMTP debugging
    // SMTP::DEBUG_OFF = off (for production use)
    // SMTP::DEBUG_CLIENT = client messages
    // SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;

    $mail->Username = 'testingtelesur@gmail.com';
    $mail->Password = 'thisisaverysecurepassword!@#';

    $mail->setFrom($from, $from);

    $mail->addAddress($to, $to);

    $mail->Subject = $subject;

    $mail->msgHTML($body, __DIR__);
    $mail->AltBody = $body;
    $mail->addAttachment($file);

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }
}
