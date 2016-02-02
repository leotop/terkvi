<?php namespace App\Http\Controllers;

use DB;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Churches;
use App\Servant;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $village = Churches::distinct()->select('village')
            ->get();
        return view('home', compact('village'));
    }

    public function create()
    {
        return view('create');
    }

    public function createPost(Request $request)
    {
        $rules = [
            'title' => 'required',
            'members' => 'integer',
            'children' => 'integer',
            'index' => 'integer|max:4|min:4',
            'phone' => 'integer',
            'email' => 'email',
            'servant_index1' => 'integer|max:4|min:4',

        ];
        $messages = [
            'title.required' => 'Поле НАЗВАНИЕ ЦЕРКВИ является обезательным',
            'members.integer' => 'Поле Количество членов (Общее) введите целое число',
            'children.integer' => 'Поле Количество членов (Детей) введите целое число',
            'index.integer' => 'Поле Почтовый индекс введите целое число',
            'index.max:4' => 'Поле Почтовый индекс max 4 цифры',
            'index.min:4' => 'Поле Почтовый индекс min 4 цифры',
            'phone.integer' => 'Поле Телефон введите целое число',
            'email' => 'Введите адрес электроной почты',
            'servant_index1.integer' => 'Поле Почтовый индекс (servant) введите целое число',
            'servant_index1.max:4' => 'Поле Почтовый индекс max 4 цифры',
            'servant_index1.min:4' => 'Поле Почтовый индекс min 4 цифры',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        $churches = new Churches();
        $key = $churches::max('id')+1;

        for ($i=1; $i<=15; $i++)
        {
            $churches = new Churches();
            $churches->key = $key;
            $churches->title = $request->title;
            $churches->region = $request->region;
            $churches->members = $request->members;
            $churches->children = $request->children;
            $churches->destinatar = $request->destinatar;
            $churches->street = $request->street;
            $churches->number = $request->number;
            $churches->apartment = $request->apartment;
            $churches->index = $request->index;
            $churches->village = $request->village;
            $churches->rayon = $request->rayon;
            $churches->phone = $request->phone;
            $churches->email = $request->email;
            $churches->webpage = $request->webpage;
            $churches->information = $request->other;

            $churches->servant_name = $request->input('servant_name'.$i);
            $churches->servant_post = $request->input('servant_post'.$i);
            $churches->servant_register = $request->input('servant_register'.$i);
            $churches->servant_register_name = $request->input('servant_register_name'.$i);
            $churches->servant_phone = $request->input('servant_phone'.$i);
            $churches->servant_mobile = $request->input('servant_mobile'.$i);
            $churches->servant_email = $request->input('servant_email'.$i);
            $churches->servant_street = $request->input('servant_street'.$i);
            $churches->servant_number = $request->input('servant_number'.$i);
            $churches->servant_apartment = $request->input('servant_apartment'.$i);
            $churches->servant_index = $request->input('servant_index'.$i);
            $churches->servant_village = $request->input('servant_village'.$i);
            $churches->servant_rayon = $request->input('servant_rayon'.$i);
            $churches->servant_other = $request->input('servant_other'.$i);

            $servant_name = $request->input('servant_name'.$i);
            $servant_principal = $request->input('servant_principal'.$i);
            if (!empty($servant_name))
            {
                if (!empty($servant_principal)) $churches->servant_post_status=1;
                $churches->save();
            }
        }
        if (empty($request->input('servant_name1'))) $churches->save();

        return redirect()->action('UserController@home');
    }

    public function record()
    {
        $churches = Churches::all();
        $servant = new Servant();

        return view('record', compact('churches'));
    }

    public function export()
    {
        $churches = Churches::with('key', 'title');

        $data = array(
           array('Церковь', 'Регион', 'Общее', 'Детей', 'Получатель', 'Улица', 'Дом', 'Квартира', 'Индекс', 'Пункт', 'Район', 'Телефон', 'Почта', 'Страница', 'Другие'),
        );

        Excel::create('Адреса церквей', function($excel) use($data)
        {
            $excel->setTitle('Contact adress');
            $excel->sheet('Sheetname', function($sheet) use($data)
            {
                $sheet->fromArray($data, null, 'A1', false, false);
                $churches = Churches::select('id', 'title', 'members')->get();
                $sheet->fromModel($churches, null, 'A1', false, false);
            });
        })->download('xlsx');

        return redirect()->action('UserController@record');
    }

    public function search()
    {
        return view('search');
    }

    public function searchPost(Request $request)
    {
        $churches_title = $request->title;
        $churches_servant = $request->servant_name;
        $churches_region = $request->region_search;
        if ($churches_region == 'Все') $churches_region = '';
        $churches_village = $request->village_search;
        if ($churches_village == 'Все') $churches_village = '';

        $churches = Churches::where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%$churches_region%")
            ->where('village', 'like', "%$churches_village%")
            ->where('servant_post_status', 1)
            ->get();

        session([
            'churches_title' => $churches_title,
            'churches_servant' => $churches_servant,
            'churches_region' => $churches_region,
            'churches_village' => $churches_village
        ]);
        ////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////
        $churches_summary_sever = Churches::select('village', 'title', 'servant_name', DB::raw("CONCAT(members + children) as all_members"))
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Северный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();
        $churches_summary_balti = Churches::select('village', 'title', 'servant_name', DB::raw("CONCAT(members + children) as all_members"))
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Бельцкий%")
            ->where('village', 'like', "%$churches_village%")
            ->get();
        $churches_summary_tentralnii = Churches::select('village', 'title', 'servant_name', DB::raw("CONCAT(members + children) as all_members"))
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Центральный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();
        $churches_summary_pridnestrovskii = Churches::select('village', 'title', 'servant_name', DB::raw("CONCAT(members + children) as all_members"))
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Приднестровский%")
            ->where('village', 'like', "%$churches_village%")
            ->get();
        $churches_summary_ujnii = Churches::select('village', 'title', 'servant_name', DB::raw("CONCAT(members + children) as all_members"))
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Южный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        $churches_mail_adress_sever = Churches::select('title', 'servant_name', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contacts"), 'servant_index', 'servant_village', 'country')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Северный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        $churches_mail_adress_balti = Churches::select('title', 'servant_name', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contacts"), 'servant_index', 'servant_village', 'country')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Бельцкий%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        $churches_mail_adress_tentralnii = Churches::select('title', 'servant_name', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contacts"), 'servant_index', 'servant_village', 'country')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Центральный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        $churches_mail_adress_pridnestrovskii = Churches::select('title', 'servant_name', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contacts"), 'servant_index', 'servant_village', 'country')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Приднестровский%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        $churches_mail_adress_ujnii = Churches::select('title', 'servant_name', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contacts"), 'servant_index', 'servant_village', 'country')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Южный%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        /////////////////////////////////////////////////////////////////////////////////////////////////////////

        $churches_full_list_sever = Churches::select('village', 'title', 'members', 'children', DB::raw("CONCAT(street, ' ', number, ' ', apartment) AS contact_adress"), 'index', 'rayon', 'phone', 'email', 'webpage', 'information', 'servant_name', 'servant_post', 'servant_register', 'servant_register_name', 'servant_phone', 'servant_mobile', 'servant_email', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contact_adress"), 'servant_index', 'servant_village', 'servant_rayon', 'servant_other')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Северный%")
            ->where('village', 'like', "%$churches_village%")
            ->orderBy('village')
            ->get();

        $churches_full_list_balti = Churches::select('village', 'title', 'members', 'children', DB::raw("CONCAT(street, ' ', number, ' ', apartment) AS contact_adress"), 'index', 'rayon', 'phone', 'email', 'webpage', 'information', 'servant_name', 'servant_post', 'servant_register', 'servant_register_name', 'servant_phone', 'servant_mobile', 'servant_email', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contact_adress"), 'servant_index', 'servant_village', 'servant_rayon', 'servant_other')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Бельцкий%")
            ->where('village', 'like', "%$churches_village%")
            ->orderBy('village')
            ->get();

        $churches_full_list_tentralnii = Churches::select('village', 'title', 'members', 'children', DB::raw("CONCAT(street, ' ', number, ' ', apartment) AS contact_adress"), 'index', 'rayon', 'phone', 'email', 'webpage', 'information', 'servant_name', 'servant_post', 'servant_register', 'servant_register_name', 'servant_phone', 'servant_mobile', 'servant_email', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contact_adress"), 'servant_index', 'servant_village', 'servant_rayon', 'servant_other')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Центральный%")
            ->where('village', 'like', "%$churches_village%")
            ->orderBy('village')
            ->get();

        $churches_full_list_pridnestrovskii = Churches::select('village', 'title', 'members', 'children', DB::raw("CONCAT(street, ' ', number, ' ', apartment) AS contact_adress"), 'index', 'rayon', 'phone', 'email', 'webpage', 'information', 'servant_name', 'servant_post', 'servant_register', 'servant_register_name', 'servant_phone', 'servant_mobile', 'servant_email', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contact_adress"), 'servant_index', 'servant_village', 'servant_rayon', 'servant_other')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Приднестровский%")
            ->where('village', 'like', "%$churches_village%")
            ->orderBy('village')
            ->get();

        $churches_full_list_ujnii = Churches::select('village', 'title', 'members', 'children', DB::raw("CONCAT(street, ' ', number, ' ', apartment) AS contact_adress"), 'index', 'rayon', 'phone', 'email', 'webpage', 'information', 'servant_name', 'servant_post', 'servant_register', 'servant_register_name', 'servant_phone', 'servant_mobile', 'servant_email', DB::raw("CONCAT(servant_street, ' ', servant_number, ' ', servant_apartment) as servant_contact_adress"), 'servant_index', 'servant_village', 'servant_rayon', 'servant_other')
            ->where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%Южный%")
            ->where('village', 'like', "%$churches_village%")
            ->orderBy('village')
            ->get();



        $number_generate = rand(0, 100);
        session(['number_generate' => $number_generate]);

        // -------------------------Краткий
        $data = array(
            array('Нас. Пункт', 'Название церкви', 'ФИО отв. служителя', 'Кол-во членов церкви (общее)'),
        );
        Excel::create('summary_list_'.$number_generate, function($excel) use($data, $churches_summary_sever, $churches_summary_balti, $churches_summary_tentralnii, $churches_summary_pridnestrovskii, $churches_summary_ujnii)
        {
            $excel->setTitle('Contact adress');
            $excel->sheet('Северный', function($sheet) use($data, $churches_summary_sever)
            {
                $sheet->cells('A1:D1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_summary_sever, null, 'A1', false, false);
            });
            $excel->sheet('Бельцкий', function($sheet) use($data, $churches_summary_balti)
            {
                $sheet->cells('A1:D1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_summary_balti, null, 'A1', false, false);
            });
            $excel->sheet('Центральный', function($sheet) use($data, $churches_summary_tentralnii)
            {
                $sheet->cells('A1:D1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_summary_tentralnii, null, 'A1', false, false);
            });
            $excel->sheet('Приднестровский', function($sheet) use($data, $churches_summary_pridnestrovskii)
            {
                $sheet->cells('A1:D1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_summary_pridnestrovskii, null, 'A1', false, false);
            });
            $excel->sheet('Южный', function($sheet) use($data, $churches_summary_ujnii)
            {
                $sheet->cells('A1:D1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_summary_ujnii, null, 'A1', false, false);
            });

        })->store('xlsx', storage_path('excel/exports'));
        // -------------------------End Краткий

        // -------------------------Почтовые адреса
        $data = array(
            array('Название церкви', 'ФИО получателя', 'Улица, номер дома, квартира', 'Индекс', 'Нас. Пункт', 'Страна'),
        );
        Excel::create('mail_adress_'.$number_generate, function($excel) use($data, $churches_mail_adress_sever, $churches_mail_adress_balti, $churches_mail_adress_tentralnii, $churches_mail_adress_pridnestrovskii, $churches_mail_adress_ujnii)
        {
            $excel->setTitle('Contact adress');
            $excel->sheet('Северный', function($sheet) use($data, $churches_mail_adress_sever)
            {
                $sheet->cells('A1:F1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_mail_adress_sever, null, 'A1', false, false);
            });
            $excel->sheet('Бельцкий', function($sheet) use($data, $churches_mail_adress_balti)
            {
                $sheet->cells('A1:F1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_mail_adress_balti, null, 'A1', false, false);
            });
            $excel->sheet('Центральный', function($sheet) use($data, $churches_mail_adress_tentralnii)
            {
                $sheet->cells('A1:F1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_mail_adress_tentralnii, null, 'A1', false, false);
            });
            $excel->sheet('Приднестровский', function($sheet) use($data, $churches_mail_adress_pridnestrovskii)
            {
                $sheet->cells('A1:F1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_mail_adress_pridnestrovskii, null, 'A1', false, false);
            });
            $excel->sheet('Южный', function($sheet) use($data, $churches_mail_adress_ujnii)
            {
                $sheet->cells('A1:F1', function($cells){
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_mail_adress_ujnii, null, 'A1', false, false);
            });

        })->store('xlsx', storage_path('excel/exports'));
        // -------------------------End Почтовые адреса

        // -------------------------Полный
        $data = array(
            array('', '', 'Кол-во членов церкви', '', 'Адрес', '', '', 'Контакты', '', '', '', 'Главный пастор / ответственный'),
            array('Нас. Пункт', 'Название церкви', 'Общее', 'Детей', 'улица, номер дома, квартира', 'Индекс', 'Район', 'Телефон', 'эл. Почта', 'веб страница', 'Другие', 'ФИО служителя', 'Служение', 'Дата рукоположения', 'Кто рукополагал', 'Телефон', 'Мобильный', 'эл. Почта', 'улица, номер дома, квартира', 'Индекс', 'Нас. Пункт', 'Район', 'Дополнительная информация'),
        );
        Excel::create('full_list_'.$number_generate, function($excel) use($data, $churches_full_list_sever, $churches_full_list_balti, $churches_full_list_tentralnii, $churches_full_list_pridnestrovskii, $churches_full_list_ujnii)
        {
            $excel->setTitle('Contact adress');
            $excel->sheet('Северный', function($sheet) use($data, $churches_full_list_sever)
            {
                $sheet->mergeCells('C1:D1');
                $sheet->mergeCells('E1:G1');
                $sheet->mergeCells('H1:K1');
                $sheet->mergeCells('L1:U1');
                $sheet->mergeCells('V1:W1');
                $sheet->cells('A1:W1', function($cells){
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:W2', function($cells){
                    $cells->setBackground('#D3D3D3');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_full_list_sever, null, 'A1', false, false);
            });
            $excel->sheet('Бельцкий', function($sheet) use($data, $churches_full_list_balti)
            {
                $sheet->mergeCells('C1:D1');
                $sheet->mergeCells('E1:G1');
                $sheet->mergeCells('H1:K1');
                $sheet->mergeCells('L1:U1');
                $sheet->mergeCells('V1:W1');
                $sheet->cells('A1:W1', function($cells){
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:W2', function($cells){
                    $cells->setBackground('#D3D3D3');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_full_list_balti, null, 'A1', false, false);
            });
            $excel->sheet('Центральный', function($sheet) use($data, $churches_full_list_tentralnii)
            {
                $sheet->mergeCells('C1:D1');
                $sheet->mergeCells('E1:G1');
                $sheet->mergeCells('H1:K1');
                $sheet->mergeCells('L1:U1');
                $sheet->mergeCells('V1:W1');
                $sheet->cells('A1:W1', function($cells){
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:W2', function($cells){
                    $cells->setBackground('#D3D3D3');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_full_list_tentralnii, null, 'A1', false, false);
            });
            $excel->sheet('Приднестровский', function($sheet) use($data, $churches_full_list_pridnestrovskii)
            {
                $sheet->mergeCells('C1:D1');
                $sheet->mergeCells('E1:G1');
                $sheet->mergeCells('H1:K1');
                $sheet->mergeCells('L1:U1');
                $sheet->mergeCells('V1:W1');
                $sheet->cells('A1:W1', function($cells){
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:W2', function($cells){
                    $cells->setBackground('#D3D3D3');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_full_list_pridnestrovskii, null, 'A1', false, false);
            });
            $excel->sheet('Южный', function($sheet) use($data, $churches_full_list_ujnii)
            {
                $sheet->mergeCells('C1:D1');
                $sheet->mergeCells('E1:G1');
                $sheet->mergeCells('H1:K1');
                $sheet->mergeCells('L1:U1');
                $sheet->mergeCells('V1:W1');
                $sheet->cells('A1:W1', function($cells){
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                $sheet->cells('A2:W2', function($cells){
                    $cells->setBackground('#D3D3D3');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->fromModel($churches_full_list_ujnii, null, 'A1', false, false);
            });
        })->store('xlsx', storage_path('excel/exports'));
        // -------------------------End Полный

        $search_churches = $request->input('search_churches');
        return view('result-summary', compact('churches'));
    }
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
    public function resultSummary()
    {
        $churches_title = session('churches_title');
        $churches_servant = session('churches_servant');
        $churches_region = session('churches_region');
        $churches_village = session('churches_village');

        $churches = Churches::where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%$churches_region%")
            ->where('village', 'like', "%$churches_village%")
            ->where('servant_post_status', 1)
            ->get();

        return view('result-summary', compact('churches'));
    }

    public function resultSummaryPost(Request $request)
    {
        $modify = $request->modify;
        $delete = $request->delete;
        $save = $request->save_change;
        $id = $request->id_table;

        if (isset($save))
        {
            $region = $request->region;
            $village = $request->village;
            $title = $request->title;
            $servant_name = $request->servant_name;
            $members = $request->members;
            $children = $request->children;
            Churches::where('id', '=', session('id'))
                ->update([
                    'region' => $region,
                    'village'=> $village,
                    'title' => $title,
                    'servant_name' => $servant_name,
                    'members' => $members,
                    'children' => $children
                ]);
            return redirect()->action('UserController@resultSummary');
        }

        if (isset($modify))
        {
            session(['id' => $id]);
            $id_modify = $id;
            $churches_title = session('churches_title');
            $churches_servant = session('churches_servant');
            $churches_region = session('churches_region');
            $churches_village = session('churches_village');
            $churches = Churches::where('title', 'like', "%$churches_title%")
                ->where('servant_name', 'like', "%$churches_servant%")
                ->where('region', 'like', "%$churches_region%")
                ->where('village', 'like', "%$churches_village%")
                ->get();
            $modify_position = Churches::find($id_modify);
            return view('result-summary', compact('churches', 'id_modify', 'modify_position'));
        }

        if (isset($delete)) Churches::destroy($id);

        return redirect()->action('UserController@resultSummary');
    }
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
    public function resultFull()
    {
        $churches_title = session('churches_title');
        $churches_servant = session('churches_servant');
        $churches_region = session('churches_region');
        $churches_village = session('churches_village');

        $churches = Churches::where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%$churches_region%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        return view('result-full', compact('churches'));
    }

    public function resultFullPost(Request $request)
    {
        $modify = $request->modify;
        $delete = $request->delete;
        $save = $request->save_change;
        $id = $request->id_table;

        if (isset($save))
        {
            $village = $request->village;
            $title = $request->title;
            $members = $request->members;
            $children = $request->children;
            $street = $request->street;
            $number = $request->number;
            $apartment = $request->apartment;
            $index = $request->index;
            $rayon = $request->rayon;
            $phone = $request->phone;
            $email = $request->email;
            $webpage = $request->webpage;
            $information = $request->information;
            $servant_name = $request->servant_name;
            $servant_register = $request->servant_register;
            $servant_register_name = $request->servant_register_name;
            $servant_phone = $request->servant_phone;
            $servant_mobile = $request->servant_mobile;
            $servant_email = $request->servant_email;
            $servant_street = $request->servant_street;
            $servant_number = $request->servant_number;
            $servant_apartment = $request->servant_apartment;
            $servant_index = $request->servant_index;
            $servant_village = $request->servant_village;
            $servant_rayon = $request->servant_rayon;
            $servant_other = $request->servant_other;
            Churches::where('id', '=', session('id'))
                ->update([
                    'village' => $village,
                    'title' => $title,
                    'members' => $members,
                    'children' => $children,
                    'street' => $street,
                    'number' => $number,
                    'apartment' => $apartment,
                    'index' => $index,
                    'rayon' => $rayon,
                    'phone' => $phone,
                    'email' => $email,
                    'webpage' => $webpage,
                    'information' => $information,
                    'servant_name' => $servant_name,
                    'servant_register' => $servant_register,
                    'servant_register_name' => $servant_register_name,
                    'servant_phone' => $servant_phone,
                    'servant_mobile' => $servant_mobile,
                    'servant_email' => $servant_email,
                    'servant_street' => $servant_street,
                    'servant_number' => $servant_number,
                    'servant_apartment' => $servant_apartment,
                    'servant_index' => $servant_index,
                    'servant_village' => $servant_village,
                    'servant_rayon' => $servant_rayon,
                    'servant_other' => $servant_other,
                ]);
            return redirect()->action('UserController@resultFull');
        }

        if (isset($modify))
        {
            session(['id' => $id]);
            $id_modify = $id;
            $churches_title = session('churches_title');
            $churches_servant = session('churches_servant');
            $churches_region = session('churches_region');
            $churches_village = session('churches_village');
            $churches = Churches::where('title', 'like', "%$churches_title%")
                ->where('servant_name', 'like', "%$churches_servant%")
                ->where('region', 'like', "%$churches_region%")
                ->where('village', 'like', "%$churches_village%")
                ->get();
            $modify_position = Churches::find($id_modify);
            return view('result-full', compact('churches', 'id_modify', 'modify_position'));
        }

        if (isset($delete)) Churches::destroy($id);

        return redirect()->action('UserController@resultFull');
    }
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
    public function resultMailAdress()
    {
        $churches_title = session('churches_title');
        $churches_servant = session('churches_servant');
        $churches_region = session('churches_region');
        $churches_village = session('churches_village');

        $churches = Churches::where('title', 'like', "%$churches_title%")
            ->where('servant_name', 'like', "%$churches_servant%")
            ->where('region', 'like', "%$churches_region%")
            ->where('village', 'like', "%$churches_village%")
            ->get();

        return view('result-mail-adress', compact('churches'));
    }

    public function resultMailAdressPost(Request $request)
    {
        $modify = $request->modify;
        $delete = $request->delete;
        $save = $request->save_change;
        $id = $request->id_table;

        if (isset($save))
        {
            $title = $request->title;
            $servant_name = $request->servant_name;
            $servant_street = $request->servant_street;
            $servant_number = $request->servant_number;
            $servant_apartment = $request->servant_apartment;
            $servant_index = $request->servant_index;
            $servant_village = $request->servant_village;
            Churches::where('id', '=', session('id'))
                ->update([
                    'title' => $title,
                    'servant_name' => $servant_name,
                    'servant_street' => $servant_street,
                    'servant_number' => $servant_number,
                    'servant_apartment' => $servant_apartment,
                    'servant_index' => $servant_index,
                    'servant_village' => $servant_village,
                ]);
            return redirect()->action('UserController@resultMailAdress');
        }

        if (isset($modify))
        {
            session(['id' => $id]);
            $id_modify = $id;
            $churches_title = session('churches_title');
            $churches_servant = session('churches_servant');
            $churches_region = session('churches_region');
            $churches_village = session('churches_village');
            $churches = Churches::where('title', 'like', "%$churches_title%")
                ->where('servant_name', 'like', "%$churches_servant%")
                ->where('region', 'like', "%$churches_region%")
                ->where('village', 'like', "%$churches_village%")
                ->get();
            $modify_position = Churches::find($id_modify);
            return view('result-mail-adress', compact('churches', 'id_modify', 'modify_position'));
        }

        if (isset($delete)) Churches::destroy($id);

        return redirect()->action('UserController@resultMailAdress');
    }
}






















