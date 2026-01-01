<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $task->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Deadline</label>
    <input type="datetime-local" name="deadline_at" class="form-control" value="{{ old('deadline_at', isset($task) ? $task->deadline_at->format('Y-m-d\TH:i') : '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Assignee</label>
    <select name="assignee_id" class="form-select" required>
        @foreach($karyawan as $user)
            <option value="{{ $user->id }}" @selected(old('assignee_id', $task->assignee_id ?? '') == $user->id)>{{ $user->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Attachments</label>
    <input type="file" name="files[]" class="form-control" multiple>
    <small class="text-muted">Supported: doc, docx, ppt, pptx, xls, xlsx, pdf, png, jpg, jpeg</small>
</div>
<button class="btn btn-success">Save</button>
