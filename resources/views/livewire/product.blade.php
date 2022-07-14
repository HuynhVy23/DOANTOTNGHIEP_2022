
      <input type="text" class="form-control" wire:model="search" placeholder=" name">
      {{-- <div style="z-index:10;background-color:bg-white;position: absolute;" class="shadow=lg">
      <a href="">aaaaaaaaaaaaaaaaaaaaaaaaa</a>
      <a href="">aaaaaaaaaaaaaaaaaaaaaaaaa</a>
      <a href="">aaaaaaaaaaaaaaaaaaaaaaaaa</a>
      </div> --}}
      {{-- <ul>
        <li>iiiiiiiiiiii</li>
        <li>iiiiiiiiiiiii</li>
      </ul> --}}
      <p>{{ $search }}</p>
      @if($contacts && $contacts->count() > 0)
      <p>aaaaaaaaa</p>
      {{-- <ul> --}}
        @foreach ($contacts as $contact)
      <p>{{ $contact->name }}</p>
      @endforeach
    {{-- </ul> --}}
    @else
    <p>none</p>
      @endif
     