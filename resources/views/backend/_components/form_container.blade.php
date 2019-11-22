<form id="{{ $id ?? "" }}" method="POST" action="{{ $action }}"{{ !empty($files) ? " enctype='multipart/form-data'" : "" }} data-parsley>
@csrf
{{ $page_type == 'create' ? '' : method_field('PUT') }}
{{ $slot }}
</form>
