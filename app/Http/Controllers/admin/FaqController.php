<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class FaqController extends Controller
{
    protected $targetLanguages = [
        'id' => 'الإندونيسية',
        'am' => 'الأمهرية',
        'hi' => 'الهندية',
        'bn' => 'البنغالية',
        'ml' => 'المالايالامية',
        'fil' => 'الفلبينية',
        'ur' => 'الأردية',
        'ta' => 'التاميلية',
        'en' => 'الإنجليزية',
        'ne' => 'النيبالية',
        'ps' => 'الأفغانية',
    ];

    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['question_ar', 'answer_ar', 'status', 'order']);

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $questionColumn = 'question_' . $code;
            $answerColumn = 'answer_' . $code;
            try {
                if (in_array($questionColumn, (new Faq())->getFillable()) && in_array($answerColumn, (new Faq())->getFillable())) {
                    $data[$questionColumn] = $tr->setTarget($code)->translate($request->input('question_ar'));
                    $data[$answerColumn] = $tr->setTarget($code)->translate($request->input('answer_ar'));
                } else {
                    Log::warning("Column {$questionColumn} or {$answerColumn} not found in Faq model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $data[$questionColumn] = null;
                $data[$answerColumn] = null;
                Log::error("Translation failed for {$code} (Faq Store): " . $e->getMessage());
            }
        }

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'تم إضافة السؤال بنجاح');
    }

    public function show(Faq $faq)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.faqs.show', compact('faq', 'targetLanguages'));
    }

    public function edit(Faq $faq)
    {
        $targetLanguages = $this->targetLanguages;
        return view('admin.faqs.edit', compact('faq', 'targetLanguages'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'question_ar' => 'required|string|max:255',
            'answer_ar' => 'required|string',
            'status' => 'required|boolean',
            'order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['question_ar', 'answer_ar', 'status', 'order']);

        $tr = new GoogleTranslate('ar');

        foreach ($this->targetLanguages as $code => $name) {
            $questionColumn = 'question_' . $code;
            $answerColumn = 'answer_' . $code;
            try {
                if (in_array($questionColumn, (new Faq())->getFillable()) && in_array($answerColumn, (new Faq())->getFillable())) {
                    $data[$questionColumn] = $tr->setTarget($code)->translate($request->input('question_ar'));
                    $data[$answerColumn] = $tr->setTarget($code)->translate($request->input('answer_ar'));
                } else {
                    Log::warning("Column {$questionColumn} or {$answerColumn} not found in Faq model fillable. Skipping translation for this column.");
                }
            } catch (\Exception $e) {
                $data[$questionColumn] = null;
                $data[$answerColumn] = null;
                Log::error("Translation failed for {$code} (Faq Update): " . $e->getMessage());
            }
        }

        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'تم تحديث السؤال بنجاح');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'تم حذف السؤال بنجاح');
    }
}
