<input type="hidden" name="type" value="{{$type}}">
<input type="hidden" name="total" value="{{$total}}">


<div class="input-container">
    <input type="text" placeholder="اسم البراند" name="brand_name" required>
</div>
<label style="display: block; margin: 8px;">اللغة المستخدمة:</label>
<div style="display: grid; gap:15px; grid-template-columns: repeat(2, 1fr)">
    <div style="display: inline-block;">
        <input class="form-check-input" type="radio" value="arabic"
               id="flexCheckDefault" name="lang">
        <label class="form-check-label" for="flexCheckDefault">
            اللغة العربية
        </label>
    </div>
    <div style="display: inline-block;">
        <input class="form-check-input" type="radio" value="english"
               id="flexCheckChecked" name="lang" checked>
        <label class="form-check-label" for="flexCheckChecked">
            اللغة الإنجليزية
        </label>
    </div>
</div>
<div class="input-container">
    <textarea type="text" placeholder="اوصف لنا سبب اختيار الاسم + معناه؟"
              name="describe_reason_choosing_name" required></textarea>
</div>
<div class="input-container">
    <textarea type="text" placeholder="اشرح لنا فكرة عمل المشروع بكلمات بسيطة"
              name="explain_idea_project" required></textarea>
</div>
<div class="input-container">
    <input type="text"
           placeholder="ان أمكن لخص لنا ما يميز خدمتك بكلمتين إلى ثلاث كلمات مختصرة جوهرية"
           name="summarize" required/>
</div>
<div class="input-container">
    <input type="text" placeholder="أبرز المنافسين" name="competitors" required/>
</div>
<div class="input-container">
    <input type="text" placeholder="ما هي الأشياء التي تميزكم عنهم ؟"
           name="distinguish_you_from_them" required/>
</div>
<div class="input-container">
    <input type="text" placeholder="من هي الفئة المستهدفة من المشروع ؟"
           name="target_group" required/>
</div>
<div class="input-container">
    <input type="text"
           placeholder="هل هناك تصور في ذهنكم عن الأشياء التي تميزكم عنهم ؟"
           name="is_picture_distinguish_you_from_them" required/>
</div>
<div class="input-container">
    <label>هل مرت عليك شعارات سابقة ونالت إعجابك إن وجد نتمنى ان ترسلها ؟</label>
    <input type="file" name="images[]" multiple/>
</div>

