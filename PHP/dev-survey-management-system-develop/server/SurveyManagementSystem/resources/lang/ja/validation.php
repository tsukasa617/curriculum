<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'        => ':attributeを承認してください。',
    'active_url'      => ':attributeは、有効なURLではありません。',
    'after'           => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'  => ':attributeには、:date以降の日付を指定してください。',
    'alpha'           => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'      => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'       => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'           => ':attributeには、配列を指定してください。',
    'before'          => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を指定してください。',
    'between'         => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'        => ":attributeには、'true'か'false'を指定してください。",
    'confirmed'      => ':attributeと:attribute確認が一致しません。',
    'date'           => ':attributeは、正しい日付ではありません。',
    'date_equals'    => ':attributeは:dateに等しい日付でなければなりません。',
    'date_format'    => ":attributeの形式は、':format'と合いません。",
    'different'      => ':attributeと:otherには、異なるものを指定してください。',
    'digits'         => ':attributeは、:digits桁にしてください。',
    'digits_between' => ':attributeは、:min桁から:max桁にしてください。',
    'dimensions'     => ':attributeの画像サイズが無効です',
    'distinct'       => ':attributeの値が重複しています。',
    'email'          => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'      => ':attributeは、次のうちのいずれかで終わらなければなりません。: :values',
    'exists'         => '選択された:attributeは、有効ではありません。',
    'file'           => ':attributeはファイルでなければいけません。',
    'filled'         => ':attributeは必須です。',
    'gt'             => [
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'file'    => ':attributeは、:value KBより大きくなければなりません。',
        'string'  => ':attributeは、:value文字より大きくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より大きくなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'file'    => ':attributeは、:value KB以上でなければなりません。',
        'string'  => ':attributeは、:value文字以上でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以上でなければなりません。',
    ],
    'image'    => ':attributeには、画像を指定してください。',
    'in'       => '選択された:attributeは、有効ではありません。',
    'in_array' => ':attributeが:otherに存在しません。',
    'integer'  => ':attributeには、整数を指定してください。',
    'ip'       => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'     => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'     => ':attributeはIPv6アドレスを指定してください。',
    'json'     => ':attributeには、有効なJSON文字列を指定してください。',
    'lt'       => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file'    => ':attributeは、:value KBより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より小さくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file'    => ':attributeは、:value KB以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以下でなければなりません。',
    ],
    'max' => [
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'file'    => ':attributeには、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下にしてください。',
        'array'   => ':attributeの項目は、:max個以下にしてください。',
    ],
    'mimes'     => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min'       => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上にしてください。',
        'array'   => ':attributeの項目は、:min個以上にしてください。',
    ],
    'not_in'                => '選択された:attributeは、有効ではありません。',
    'not_regex'             => ':attributeの形式が無効です。',
    'numeric'               => ':attributeには、数字を指定してください。',
    'password'              => 'パスワードが正しくありません。',
    'present'               => ':attributeが存在している必要があります。',
    'regex'                 => ':attributeには、有効な正規表現を指定してください。',
    'required'              => ':attributeは、必ず指定してください。',
    'required_if'           => ':otherが:valueの場合、:attributeを指定してください。',
    'required_unless'       => ':otherが:values以外の場合、:attributeを指定してください。',
    'required_with'         => ':valuesが指定されている場合、:attributeも指定してください。',
    'required_with_all'     => ':valuesが全て指定されている場合、:attributeも指定してください。',
    'required_without'      => ':valuesが指定されていない場合、:attributeを指定してください。',
    'required_without_all'  => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                  => ':attributeと:otherが一致しません。',
    'size'                  => [
        'numeric' => ':attributeには、:sizeを指定してください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
        'array'   => ':attributeの項目は、:size個にしてください。',
    ],
    'starts_with' => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'      => ':attributeには、文字を指定してください。',
    'timezone'    => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'      => '指定の:attributeは既に使用されています。',
    'uploaded'    => ':attributeのアップロードに失敗しました。',
    'url'         => ':attributeは、有効なURL形式で指定してください。',
    'uuid'        => ':attributeは、有効なUUIDでなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        //-----------------顧客登録で使用----------------------//
        'contractor_kana' => [ //契約者フリガナ
            'regex' => ':attributeは全角カナを入力してください。',
        ],
        'responder_kana' => [ //対応者フリガナ
            'regex' => ':attributeは全角カナを入力してください。',
        ],
        'zipcode' => [ //郵便番号
            'digits' => ':attributeは:digitsケタで入力してください。',
            'regex' => ':attributeはハイフン[-]無しの半角英数で入力してください。',
        ],
        'contractor_contact' => [ //契約者連絡先
            'regex' => ':attributeはハイフン[-]無しの半角英数を入力してください。',
        ],
        'responder_contact' => [ //対応者連絡先
            'regex' => ':attributeはハイフン[-]無しの半角英数を入力してください。',
        ],
        'other_contact' => [ //その他連絡先
            'regex' => ':attributeはハイフン[-]無しの半角英数を入力してください。',
        ],
        'email' => [ //メールアドレス
            'email' => ':attributeは有効なメールアドレス形式を入力してください。',
        ],
        //-----------------顧客登録 csv----------------------//
        'values.*.survey_name' => [ //csv 調査会社
            'required' => ':attribute行目の調査会社は必ず入力してください。',
            'exists' => ':attribute行目の調査会社は登録されていません。',
        ],
        'values.*.member' => [ //csv ID
            'required' => ':attribute行目のIDは必ず入力してください。',
            'max' => ':attribute行目のIDは10字以下にして下さい。',
            'unique' => ':attribute行目のIDはすでに使用されています。',
        ],
        'values.*.contractor' => [ //csv 氏名
            'required' => ':attribute行目の氏名は必ず入力してください。',
        ],
        'values.*.address' => [ //csv 住所
            'required' => ':attribute行目の住所は必ず入力してください。',
        ],
        'values.*.contractor_contact' => [ //csv 連絡先
            'required' => ':attribute行目の連絡先は必ず入力してください。',
        ],
        //---------------------------------------//
        //-----------------法人顧客登録で使用----------------------//
        'member' => [ //ID
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'quotation_money' => [ //見積額
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'certification_money' => [ //認定額
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'fee' => [ //お客様手数料
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'referral_rate' => [ //紹介率
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'referral_rate_2' => [ //紹介率
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'referral_rate_3' => [ //紹介率
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'survey_referral' => [ //調査会社手数料
            'numeric' => ":attributeには、半角英数を入力してください。",
        ],
        'riguranto_fee' => [ //リグラント手数料
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        //-----------------法人顧客登録 csv----------------------//
        'values.*.contact_method' => [ //csv 連絡先
            'required' => ':attribute行目の連絡先は必ず入力してください。',
        ],
        //---------------------------------------//
        //-----------------法人顧客ステータス登録で使用----------------------//
        'status_number' => [ //ステータス番号
            'regex' => ":attributeには、半角英数を入力してください。",
        ],
        'status_name' => [ //ステータス名
            'unique' => '指定の:attributeは既に使用されています。',
        ],
        //---------------------------------------//
        //---------------取次店登録で使用----------------------//
        'trader_email' => [ //メールアドレス
            'email' => ':attributeは有効なメールアドレス形式を入力してください。',
        ],
        'trader_zipcode'  => [ //郵便番号
            'digits' => ':attributeは:digitsケタで入力してください。',
            'regex' => ':attributeはハイフン[-]無しの半角英数で入力してください。',
        ],
        'trader_phone'  => [ //契約者連絡先
            'regex' => ':attributeはハイフン[-]無しの半角英数を入力してください。',
        ],
        'trader_phone_2'  => [ //契約者連絡先
            'regex' => ':attributeはハイフン[-]無しの半角英数を入力してください。',
        ],
        //---------------------------------------//
        //---------------ユーザー登録・編集で使用----------------------//
        'password_dummy' => [ //ログインパスワード
            'required' => ':attributeは既に使用されています。',
        ],
        //---------------------------------------//
        //-----------------LPで使用----------------------//
        'city' => [
            'regex' => ':attributeは番地まで入力してください。:attributeは半角数字を入力してください。',
        ],
        //---------------------------------------//
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        //-----------------LPで使用----------------------//
        'prefecture' => '都道府県',
        'city' => '市区町村',
        //---------------------------------------//
        //-----------------個人顧客登録で使用----------------------//
        'zipcode' => '郵便番号',
        'address' => '住所',
        'contractor' => '氏名',
        'contractor_contact' => '連絡先',
        'mail_address' => 'メールアドレス',
        'fire_insurance_flg' => '火災保険の加入状況',
        'client_fee' => '請求手数料',
        'survey_referral' => '調査会社手数料（％）',
        'trader_referral' => '取次店手数料（％）',
        'drawing'  => 'その他データ',
        'agreement'  => '合意書データ',
        'insurance_policy'  => '保険証券データ',
        'report'  => '報告書データ',
        'quotation'  => '見積書データ',
        'certification'  => '認定書データ',
        'bill_issue'  => '請求書データ',
        //---------------------------------------//
        //-----------------法人顧客登録で使用----------------------//
        'member' => 'ID',
        'quotation_money' => '見積額',
        'certification_money' => '認定額',
        'fee' => 'お客様手数料',
        'referral_rate' => '紹介率',
        'referral_rate_2' => '紹介率',
        'referral_rate_3' => '紹介率',
        'survey_referral' => '調査会社手数料',
        'riguranto_fee' => 'リグラント手数料',
        //-----------------法人顧客ステータス登録で使用----------------------//
        'status_number' =>'ステータス番号',
        'status_name' =>'ステータス名',
        //---------------------------------------//
        //-----------------法人顧客流入経路登録で使用----------------------//
        'advertising_name' =>'流入経路名',
        //---------------------------------------//
        //---------------取次店登録で使用----------------------//
        'trader_name' => '取次店',
        'trader_email' => 'メールアドレス',
        'affiliated_company' => '所属企業',
        'trader_zipcode'  => '郵便番号',
        'trader_address'  => '住所',
        'trader_phone'  => '電話番号',
        'trader_phone_2'  => '電話番号2',
        'bank_acount_number' => '口座番号',
        //---------------------------------------//
        //---------------ユーザー登録・編集で使用----------------------//
        'login' => 'ログインID',
        'username' => 'ユーザー名',
        'password' => 'パスワード',
        'auth' => '権限',
        'auth_name' => '権限',
        'password_dummy' => 'そのパスワード',
        //---------------------------------------//
        //---------------調査会社 登録・編集で使用----------------------//
        'survey_name' => '調査会社',
        'survey_zipcode' => '郵便番号',
        'survey_address' => '住所',
        'survey_phone' => '電話番号',
        'survey_email' => 'メールアドレス',
        'survey_url' => 'Webサイト',
        'registered_user' => '登録ユーザー',
        //---------------------------------------//
    ],
];
