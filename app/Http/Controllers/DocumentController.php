<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentController extends Controller
{
    public function ThesisRequestLetter(Request $request, Thesis $thesis)
    {
        $date = $request->validate([
            'date' => 'required',
        ])['date'];
        $date = date("d.m.Y", strtotime($date));
        $data = [
            'student_fullname_genetive' => $thesis->student->fullnameGenitive(),
            'student_fullname_short' => $thesis->student->fullnameShort(),
            'group_number' => $thesis->student->group->title,
            'thesis_title' => $thesis->title,
            'professor_fullname' => $thesis->professor->fullname(),
            'professor_fullname_short' => $thesis->professor->fullnameShort(),
            'head_of_department' => $thesis->student->department->head_fullname_dative,
            'date' => $date,
        ];

        $templatePath = storage_path('app/templates/шаблон заявления на вкр.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }
        $outputPath = storage_path('app/output/RequestLetter'. $thesis->id .'.docx');
        $templateProcessor->saveAs($outputPath);

        return Response::download($outputPath, 'Заявление.docx')->deleteFileAfterSend(true);
    }

    public function ThesisReview(Request $request, Thesis $thesis)
    {
        $form_fields = $request->validate([
            'date' => 'required',
            'review_body' => 'required',
        ]);
        $date = date("d.m.Y", strtotime($form_fields['date']));
        $review_body = $form_fields['review_body'];
        // Разбейте многострочный текст на отдельные строки
        $lines = explode("\n", $review_body);
        
        // Создайте строку для замены в шаблоне с учетом переходов на новую строку
        $formatted_body = '';
        foreach ($lines as $line) {
            // Добавьте каждую строку с тегом <w:br /> для новой строки
            $formatted_body .= htmlspecialchars($line, ENT_QUOTES, 'UTF-8') . '<w:br />';
        }

        $data = [
            'student_fullname_genetive' => $thesis->student->fullnameGenitive(),
            'group_number' => $thesis->student->group->title,
            'thesis_title' => $thesis->title,
            'faculty' => $thesis->student->faculty->title,
            'department' => $thesis->student->department->title,
            'professor_fullname' => $thesis->professor->fullname(),
            'date' => $date,
        ];

        $templatePath = storage_path('app/templates/шаблон отзыва на вкр.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }
        $templateProcessor->setValue('review_body', $formatted_body);

        $outputPath = storage_path('app/output/Review'. $thesis->id .'.docx');
        $templateProcessor->saveAs($outputPath);

        return Response::download($outputPath, 'Отзыв.docx')->deleteFileAfterSend(true);
    }
}
