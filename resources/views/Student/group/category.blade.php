<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h2 class="text-center display-4">{{ $page_title }}</h2>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        @forelse ($groups as $group)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        @php
                                            $path = $group->image == null ? '/assets/img/image-placeholder.png' : '/assets/uploads/' . $group->image;
                                        @endphp
                                        <img src="{{ $path }}" class="img-fluid" alt="{{__('Photo')}}"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="col px-4">
                                        <div>
                                            <div class="float-right">created at: {{ $group->created_at }}</div>
                                            <h3>{{ $group->name }}</h3>
                                            <p class="mb-0">{{ $group->description }}</p>
                                            @php
                                                $group_user = $group
                                                    ->users()
                                                    ->pluck('id')
                                                    ->toArray();
                                            @endphp
                                            @if (!in_array(auth('student')->id(), $group_user))
                                                <button class="btn btn-outline-primary join"
                                                    onclick="joinGroup({{ $group->id }})">{{__('Join')}}</button>
                                            @else
                                                <a href="{{ route('student.group.index', $group->id) }}"
                                                    class="btn btn-outline-primary">{{__('Go')}}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h4 class="text-center">{{ __('There is no data to display') }}</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function joinGroup(id) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "group/join/" + id,
            type: "POST",
            groupType: "json",
            success: function(result) {
                console.log(result);
                if (result) {
                    $('.join').css("display", "none")
                    Toast.fire({
                        icon: "{{__('Success')}}",
                        title: "{{__('The request to join has been successfully sent.')}}"
                    })
                } else {
                    Toast.fire({
                        icon: "{{__('Error')}}",
                        title: "{{__('The request was not sent, a problem occurred.')}}"
                    })
                }
            },
        });
    }
</script>