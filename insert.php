<!-- 契約情報登録FORM -->
<div class="add_btn">情報登録</div>
<div class="insert_wrap">
    <h2>契約情報登録</h2>
    <form action="insert_done.php" method="post" class="input_form">
        <div class="input_item">
            <label for="sname">サービス名</label>
            <input type="text" name="sname" id="sname" class="inputarea">
        </div>
        <div class="input_item">
            <label for="url">サービスURL</label>
            <input type="url" name="url" id="url" class="inputarea">
        </div>
        <div class="input_item">
            <label for="mail">メールアドレス</label>
            <input type="email" name="mail" id="mail" class="inputarea">
        </div>
        <div class="input_item">
            <label for="plan">利用プラン</label>
            <input type="text" name="plan" id="plan" class="inputarea">
        </div>
        <div class="input_item">
            <label for="payment">支払有無</label>
            <select name="payment" id="payment" class="inputarea">
                <option value=""></option>
                <option value="無料">無料</option>
                <option value="月払い">月払い</option>
                <option value="年払い">年払い</option>
                <option value="その他">その他</option>
            </select>
        </div>
        <div class="input_item">
            <label for="note">補足</label>
            <input type="text" name="note" id="note" class="inputarea">
        </div>
        <div class="input_item testradio">
            <div>色選択</div>
            <div class="colors">
                <input type="radio" name="color" id="pink" value="pink">
                <label for="pink"><span class="color pink"></span></label>
                <input type="radio" name="color" id="yellow" value="yellow">
                <label for="yellow"><span class="color yellow"></span></label>
                <input type="radio" name="color" id="green" value="green">
                <label for="green"><span class="color green"></span></label>
                <input type="radio" name="color" id="blue" value="blue">
                <label for="blue"><span class="color blue"></span></label>
                <input type="radio" name="color" id="purple" value="purple">
                <label for="purple"><span class="color purple"></span></label>
                <input type="radio" name="color" id="gray" value="gray">
                <label for="gray"><span class="color gray"></span></label>
            </div>
        </div>
        <div>
            <input type="submit" value="登録" id="insert" class="submit_btn">
        </div>
    </form>
</div>