# Prompt Engineering Log - Expense Management System

> Tài liệu này ghi lại các prompt được sử dụng trong quá trình phát triển hệ thống quản lý chi tiêu, được cấu trúc theo best practices của Prompt Engineering.

---

## 1. UI/UX Enhancement Prompts

### 1.1 Logo Sizing Adjustment
**Context:** Điều chỉnh kích thước logo trên trang authentication

**Prompt:**
```
Tôi muốn logo "EXM" ở form đăng nhập, đăng ký và quên mật khẩu có kích thước lớn hơn
```

**Kỹ thuật:** Direct instruction với context cụ thể
**Kết quả:** Tăng kích thước logo từ 48px lên 80px trong layout auth

---

### 1.2 Color Picker UX Improvement
**Context:** Cải thiện trải nghiệm chọn màu sắc trong form tạo danh mục

**Prompt:**
```
Ở cái phần thêm danh mục này, tôi thấy chỗ chọn màu sắc nhận diện này hơi khó chọn, 
bạn có ý tưởng gì không
```

**Kỹ thuật:** Problem statement + Open-ended question
**Kết quả:** Thay thế color picker mặc định bằng:
- Preset color palette (9 màu)
- Custom color picker
- Hex input field
- Visual feedback với ring highlight

---

### 1.3 Input Field Contrast Enhancement
**Context:** Tăng độ tương phản của input fields

**Prompt:**
```
Màu của hai phần kia có vẻ hơi nhạt
```

**Kỹ thuật:** Visual feedback với context từ screenshot
**Kết quả:** Tăng opacity background và text color cho input fields

---

## 2. Visual Design Prompts

### 2.1 Category Badge Redesign
**Context:** Cải thiện hiển thị màu sắc category trong danh sách

**Prompt:**
```
Tại sao nó bị mờ thế này, có thể cho đậm hơn không, phần mà tôi bôi đỏ
```

**Kỹ thuật:** Visual reference + Specific request
**Iteration process:**
1. Thử CSS filters (saturate, brightness, contrast)
2. Thử tăng kích thước icon
3. Cuối cùng: Redesign hoàn toàn badge

**Final Solution:**
```html
<div style="background-color: {{ $color }}20; border: 2px solid {{ $color }};">
    <span style="color: {{ $color }};">{{ $name }}</span>
</div>
```

---

### 2.2 Consistent Badge Application
**Context:** Áp dụng thiết kế badge nhất quán

**Prompt 1:**
```
Có thể đưa cái logo này thay vào phần "giao dịch gần đây" ở trang bảng điều khiển không
```

**Prompt 2:**
```
Tốt, áp dụng tương tự cho phần "tên danh mục" trong "danh mục chi tiêu"
```

**Kỹ thuật:** Progressive refinement + Consistency request
**Kết quả:** Badge design được áp dụng đồng nhất trên:
- Expenses index
- Dashboard recent transactions
- Categories index

---

## 3. Data Display Optimization Prompts

### 3.1 Column Removal
**Context:** Đơn giản hóa bảng hiển thị

**Prompt:**
```
Có thể bỏ cột "màu sắc" trong phần "danh mục chi tiêu không", 
tôi không cần hiển thị tên màu sắc
```

**Kỹ thuật:** Explicit instruction + Reasoning
**Kết quả:** Xóa cột redundant, màu sắc vẫn hiển thị qua badge

---

## 4. Prompt Engineering Best Practices Demonstrated

### 4.1 Iterative Refinement Pattern
```
Initial Request → Feedback → Adjustment → Feedback → Final Solution
```

**Example:**
1. "Logo nhỏ" → Tăng size-20 → "Biến mất"
2. → Quay về size-12 → "OK" 
3. → Thử scale-150 → "Vẫn nhỏ"
4. → Dùng inline style → ✓ Success

**Lesson:** Incremental changes với validation từng bước

---

### 4.2 Visual Context Enhancement
**Technique:** Sử dụng screenshot + highlight vùng cần thay đổi

**Example:**
```
[Screenshot với vùng bôi đỏ] + "Phần mà tôi bôi đỏ"
```

**Benefit:** Giảm ambiguity, tăng accuracy

---

### 4.3 Problem-Solution Dialogue
**Pattern:**
```
User: "Có vấn đề X"
AI: "Đề xuất giải pháp A, B, C"
User: "Thử A"
AI: Implement A
User: Feedback
AI: Adjust hoặc pivot sang B/C
```

**Example:** Color picker improvement
- Problem: "Khó chọn màu"
- Solutions offered: Preset palette, better picker, combined approach
- Implemented: Combined approach
- Result: Better UX

---

## 5. Technical Prompt Patterns

### 5.1 Component Modification Pattern
```
[Action] + [Target Component] + [Desired Outcome] + [Optional: Constraint]
```

**Examples:**
- "Tăng kích thước logo ở form đăng nhập"
- "Áp dụng badge design cho danh mục chi tiêu"
- "Bỏ cột màu sắc trong bảng"

---

### 5.2 Styling Adjustment Pattern
```
[Visual Issue] + [Location] + [Desired State]
```

**Examples:**
- "Màu nhạt" + "ô vuông category" + "đậm hơn"
- "Input fields" + "form tạo danh mục" + "màu đậm hơn"

---

### 5.3 Consistency Request Pattern
```
"Áp dụng [Design/Pattern] tương tự cho [Target]"
```

**Examples:**
- "Áp dụng badge design cho giao dịch gần đây"
- "Áp dụng tương tự cho tên danh mục"

---

## 6. Key Learnings

### 6.1 Effective Prompt Characteristics
✅ **Specific:** "Logo ở form đăng nhập" thay vì "Logo"
✅ **Contextual:** Cung cấp screenshot khi cần
✅ **Iterative:** Sẵn sàng refine qua nhiều lần
✅ **Clear feedback:** "Vẫn nhỏ", "Được rồi", "Không thay đổi"

### 6.2 Common Pitfalls Avoided
❌ Vague requests: "Làm đẹp hơn"
❌ No feedback: Không báo kết quả sau thay đổi
❌ Too many changes at once: Khó debug
✅ Instead: Từng thay đổi nhỏ + validation

### 6.3 Troubleshooting Pattern
```
1. Make change
2. Clear cache (view:clear, cache:clear)
3. Hard refresh browser
4. Verify result
5. Provide feedback
```

---

## 7. Prompt Templates for Future Use

### Template 1: UI Component Modification
```
Tôi muốn [component] ở [location] có [desired change].
[Optional: Lý do hoặc context]
```

### Template 2: Visual Issue Report
```
[Component] ở [location] bị [issue]. 
Có thể [suggested solution] không?
[Optional: Screenshot]
```

### Template 3: Consistency Request
```
Áp dụng [design/pattern] tương tự cho [target component] 
như đã làm ở [reference component]
```

### Template 4: Feature Enhancement
```
Ở phần [feature], tôi thấy [current issue].
Bạn có ý tưởng gì để [improvement goal]?
```

### Template 5: Simplification Request
```
Có thể bỏ/đơn giản hóa [element] trong [location] không?
[Optional: Lý do]
```

---

## 8. Session Summary

**Total Prompts:** ~15-20 prompts
**Success Rate:** ~90% (với iteration)
**Key Achievements:**
- ✅ Logo sizing optimization
- ✅ Color picker UX improvement
- ✅ Badge design system implementation
- ✅ Consistent visual language across app
- ✅ Simplified data display

**Time Efficiency:**
- Average iterations per feature: 2-3
- Cache clearing required: 3 times
- Major redesigns: 1 (badge system)

---

## 9. Recommendations for Future Prompts

### For UI/UX Changes:
1. Provide visual context (screenshots)
2. Be specific about location
3. Describe desired outcome clearly
4. Give feedback after each change
5. Request alternatives if first solution doesn't work

### For Technical Implementation:
1. Specify exact component/file if known
2. Mention constraints (performance, compatibility)
3. Ask for explanation if needed
4. Validate changes incrementally

### For Design Consistency:
1. Reference existing patterns
2. Request application across similar components
3. Maintain design system documentation

---

## 10. Meta-Prompt for This Document

**Approach:**
- Reviewed entire conversation history
- Extracted key prompts and patterns
- Structured using Prompt Engineering best practices
- Added analysis and learnings
- Created reusable templates

---

**Document Version:** 1.0  
**Last Updated:** January 28, 2026  
**Project:** Expense Management System  
**Author:** Prompt Engineering Intern
