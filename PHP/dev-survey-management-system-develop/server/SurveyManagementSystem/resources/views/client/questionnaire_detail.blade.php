@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">アンケート回答詳細</span>
</div>
<div class="container">
    <div class="text-right mb-2">
        <button onclick="location.href='{{ action('ClientController@questionnaire_all') }}'" class="btn btn-info">一覧に戻る</button>
    </div>
    <div class="row">
        <table class="table col-sm-3">
            <tr><th>会員番号</th></tr>
            <tr><td>{{$answers["member_id"]}}</td></tr>
        </table>

        <table class="table col-sm-3">
            <tr><th>氏名</th></tr>
            <tr><td>{{$answers["contractor"]}}</td></tr>
        </table>

        <table class="table col-sm-3">
            <tr><th>フリガナ</th></tr>
            <tr><td>{{$answers["contractor_kana"]}}</td></tr>
        </table>

        <table class="table col-sm-3">
            <tr><th>連絡先</th></tr>
            <tr><td>{{$answers["contractor_contact"]}}</td></tr>
        </table>

        <table class="table col-sm-6">
            <tr><th>メールアドレス</th></tr>
            <tr><td>{{$answers["email"]}}</td></tr>
        </table>

        <table class="table col-sm-3">
            <tr><th>都道府県</th></tr>
            <tr><td>{{$answers["prefectures"]}}</td></tr>
        </table>

        <table class="table col-sm-3">
            <tr><th>市町村</th></tr>
            <tr><td>{{$answers["city"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>1. 物件を所有されていますか（複数回答可）</th></tr>
            <tr><td>{{$answers["Q1"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>2. その他と回答した方は何を所有しているか教えてください。</th></tr>
            <tr><td>{{$answers["Q2"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>3. 火災・地震保険に加入されていますか。</th></tr>
            <tr><td>{{$answers["Q3"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>4. 火災保険は、契約内容によっては火災以外（風・雨・水漏れ・盗難・過失等）で家屋や家財に対する損害が出た場合に、補償されることをご存じですか。</th></tr>
            <tr><td>{{$answers["Q4"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>5. 火災保険は過去3年に遡って、被害があったときに契約をしていれば、現在契約していなくても保険請求ができることをご存じですか。</th></tr>
            <tr><td>{{$answers["Q5"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>6. 火災保険は保険請求をしても、翌年の保険料が上がらないことをご存じですか。</th></tr>
            <tr><td>{{$answers["Q6"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>7. 火災保険証券の写真をお送りいただく事は可能ですか。
（契約者名・所在地・契約期間が分かる保険の条件が分かるもの）<br>
お送りいただいた方には、保険内容に関して、有益な情報提供をさせていただきます。</th></tr>
            <tr><td>{{$answers["Q7"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>8. 今回物件の無料調査が可能です。調査の中で風災・地震による損傷が見つかった場合に保険金額として数十万単位で得られる可能性もございます。（平均で約50万円）<br>
無料調査のご依頼をご希望されますか？（条件がございますので必ず調査が行えるものではありません）</th></tr>
            <tr><td>{{$answers["Q8"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>9. あなたの周りで以下の所有者でご紹介いただけそうな方がおりますか？（複数回答可）</th></tr>
            <tr><td>{{$answers["Q9"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>10. 現在所有されている物件の所在地について該当するエリアがあれば教えてください。（複数回答可）</th></tr>
            <tr><td>{{$answers["Q10"]}}</td></tr>
        </table>

        <table class="table col-sm-12">
            <tr><th>11. 3年以内に火災保険での保険請求をしたことがありますか。</th></tr>
            <tr><td>{{$answers["Q11"]}}</td></tr>
        </table>
        
        <table class="table col-sm-12">
            <tr><th>12. 『物件の無料調査』をされる場合、 万が一、保険が下りなかった場合でも、現地調査や資料作成などに掛かった費用が請求されることは一切ありません。<br>
成功報酬手数料は保険請求額の50%です。<br>
<br>
※調査希望の方へは、調査担当会社から日程調整のためのお電話が入ります。</th></tr>
            <tr><td>{{$answers["Q12"]}}</td></tr>
        </table>

    </div>
</div>
@endsection