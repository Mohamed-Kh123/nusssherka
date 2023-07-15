<input type="hidden" name="type" value="soshal-mydya">
<input type="hidden" name="total" value="{{$total}}">

<div class="input-container">
    <input type="text" placeholder="اسم المؤسسة" name="org_name" required>
</div>
<div class="input-container">
    <textarea placeholder="تعريف عام بالمشروع" name="general_def"
              required></textarea>
</div>
<div class="input-container">
    <textarea placeholder="بيانات التواصل" name="contacts" required></textarea>
</div>
<div class="input-container">
    <input type="text" placeholder="أبرز المنافسين" name="competitors" required>
</div>
<div class="input-container">
    <input type="text" placeholder="المنطقة الجغرافية" name="geographical_area">
</div>
<div class="input-container">
    <textarea placeholder="محتوى التصميم" name="design_content"
              required></textarea>
</div>
<div class="input-container">
    <input type="text" placeholder="ملاحظات للمصمم" name="notes">
</div>
<div class="input-container">
    <label>إرفق الشعارات وملفات الهوية</label>
    <input type="file" name="images[]" multiple>
</div>
