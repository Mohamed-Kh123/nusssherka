<input type="hidden" name="type" value="{{$type}}">
<input type="hidden" name="total" value="{{$total}}">

<div class="input-container">
    <input type="text" placeholder="اسم المؤسسة" name="org_name" required>
</div>

<div class="input-container">
    <textarea placeholder="تعريف عام بالمشروع" name="general_def"
              required></textarea>
</div>
<label style="display: block; margin: 8px;">مقاس الفيديو:</label>
<div style="display: grid; gap:15px; grid-template-columns: repeat(2, 1fr)">
    <div style="display: inline-block;">
        <input class="form-check-input" type="checkbox" value="instagram"
               id="flexCheckDefault" name="size[]">
        <label class="form-check-label" for="flexCheckDefault">
            انستقرام
        </label>
    </div>
    <div style="display: inline-block;">
        <input class="form-check-input" type="checkbox" value="snap"
               id="flexCheckChecked" name="size[]" checked>
        <label class="form-check-label" for="flexCheckChecked">
            سناب
        </label>
    </div>
    <div style="display: inline-block;">
        <input class="form-check-input" type="checkbox" value="twitter"
               id="flexCheckChecked" name="size[]" checked>
        <label class="form-check-label" for="flexCheckChecked">
            تويتر
        </label>
    </div>
</div>
<label style="display: block; margin: 8px;">نوع الفيديو:</label>
<div style="display: grid; gap:15px; grid-template-columns: repeat(2, 1fr)">
    <div style="display: inline-block;">
        <input class="form-check-input" type="checkbox" value="moshn"
               id="flexCheckDefault" name="video_type[]">
        <label class="form-check-label" for="flexCheckDefault">
            موشن
        </label>
    </div>
    <div style="display: inline-block;">
        <input class="form-check-input" type="checkbox" value="montage"
               id="flexCheckChecked" name="video_type[]" checked>
        <label class="form-check-label" for="flexCheckChecked">
            مونتاج
        </label>
    </div>
</div>

<div class="input-container">
    <input type="text" placeholder="رقم واتس للتواصل" name="whats_up" required/>
</div>
<div class="input-container">
    <textarea placeholder="بيانات التواصل" name="contacts" required></textarea>
</div>

<div class="input-container">
    <input type="text" placeholder="المنطقة الجغرافية" name="geographical_area">
</div>

<div class="input-container">
    <input type="text" placeholder="أبرز المنافسين" name="competitors" required/>
</div>

<div class="input-container">
    <input type="text"
           placeholder="ملاحظات للمصمم"
           name="notes" required/>
</div>
<div class="input-container">
    <label>أرفق الشعار وملفات الهوية</label>
    <input type="file" name="images[]" multiple/>
</div>

