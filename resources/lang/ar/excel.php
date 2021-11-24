<?php

return [
    'fields' => [
        'term' => 'الفصل التدريبي',
        'college' => 'الوحدة التدريبية',
        'certificate' => 'جزء الفصل',
        'specialty' => 'القسم',
        'subject_code' => 'المقرر',
        'subject_name' => 'اسم المقرر',
        'reference' => 'الرقم المرجعي',
        'contact_hours' => 'ساعات الاتصال',
        'classification' => 'نوع الشعبة',
        'days' => 'أيام',
        'times' => 'أوقات',
        'building' => 'مبنى',
        'hall' => 'قاعة',
        'capacity' => 'سعة',
        'registered' => 'مسجلين',
        'rest' => 'متبقي',
        'instructor_name' => 'المدرب',
        'instructor_id' => 'رقم الحاسب',
    ],

    'rules' => [
        'المقرر' => 'required',
        'القسم' => 'required',
        'الرقم المرجعي' => 'required',
        'نوع الشعبة' => 'required',
        'أيام' => 'required',
        'أوقات' => 'required',
        'قاعة' => 'required',
        'المدرب' => 'required',
        'رقم الحاسب' => 'required',
    ],

    'failure' => 'خطأ في الصف رقم :row، الحقل :attribute غير موجود!',
];
