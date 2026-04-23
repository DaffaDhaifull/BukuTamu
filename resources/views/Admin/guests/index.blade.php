@extends('Admin.layouts.layout')

@section('title', 'Kelola Tamu')

@section('content')
  <!-- Page Header & Breadcrumbs -->
  <div class="animate-fade-in delay-1 mb-2 flex flex-col gap-1">
    <nav class="mb-1 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-stone-400">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center transition-colors hover:text-brand-600 dark:hover:text-brand-400">
        <i class="hgi-stroke hgi-home-01 text-lg"></i>
      </a>
      <i class="hgi-stroke hgi-arrow-right-01 text-sm opacity-50"></i>
      <span class="font-semibold text-slate-800 dark:text-stone-200">Kelola Tamu</span>
    </nav>
    <div class="mt-1 flex flex-wrap items-start justify-between gap-3">
      <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-stone-100">Kelola Tamu</h1>
        <p class="text-sm text-slate-500 dark:text-stone-400">Kelola data {{ number_format($guests->total()) }} tamu terdaftar.</p>
      </div>
      <button
        data-modal-target="addGuestModal"
        class="flex h-10 items-center gap-2 rounded-xl bg-brand-600 px-3 text-sm font-semibold text-white shadow-md shadow-brand-500/20 transition-all hover:bg-brand-700 active:scale-95 sm:px-4"
      >
        <i class="hgi-stroke hgi-add-01 text-lg"></i>
        <span>Tambah Tamu</span>
      </button>
    </div>
  </div>

  <!-- Success Message -->
  @if(session('success'))
  <div class="animate-fade-in rounded-xl border border-emerald-200 bg-emerald-50 p-4 dark:border-emerald-500/20 dark:bg-emerald-500/10">
    <div class="flex items-center gap-3">
      <i class="hgi-stroke hgi-checkmark-circle-01 text-xl text-emerald-600 dark:text-emerald-400"></i>
      <p class="text-sm font-medium text-emerald-700 dark:text-emerald-300">{{ session('success') }}</p>
    </div>
  </div>
  @endif

  <!-- Guest Table Area -->
  <div class="animate-fade-in delay-2 overflow-hidden rounded-2xl bg-white opacity-0 shadow-card dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark">
    <!-- Table Actions/Filters -->
    <div class="flex flex-col items-center justify-between gap-4 border-b border-slate-100 bg-white p-6 sm:flex-row dark:border-transparent dark:bg-dark-card">
      <div class="flex w-full gap-3 sm:w-auto">
        <form method="GET" action="{{ route('admin.guests.index') }}" class="relative w-full sm:w-72">
          <i class="hgi-stroke hgi-search-01 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari tamu..."
            class="h-10 w-full rounded-xl border border-slate-200 bg-white pl-10 pr-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200"
          />
        </form>
      </div>
      <div class="flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-stone-400">
        <span>Menampilkan {{ $guests->firstItem() ?? 0 }} - {{ $guests->lastItem() ?? 0 }} dari {{ number_format($guests->total()) }} data</span>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="border-b border-slate-100 bg-white text-xs font-semibold uppercase tracking-wider text-slate-500 dark:border-transparent dark:bg-dark-card/50 dark:text-stone-400">
            <th class="px-6 py-4">No</th>
            <th class="px-6 py-4">
              <div class="flex cursor-pointer items-center gap-2 hover:text-slate-700 dark:hover:text-stone-300">
                Nama
              </div>
            </th>
            <th class="px-6 py-4">Asal Sekolah</th>
            <th class="px-6 py-4">No. HP</th>
            <th class="px-6 py-4">Waktu Daftar</th>
            <th class="px-6 py-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
          @forelse($guests as $index => $guest)
          <tr class="group bg-white transition-colors hover:bg-slate-50 dark:bg-dark-card dark:hover:bg-dark-hover">
            <td class="px-6 py-4">
              <span class="text-sm font-medium text-slate-600 dark:text-stone-400">{{ $guests->firstItem() + $index }}</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex cursor-pointer items-center gap-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-brand-100 text-sm font-bold text-brand-700 dark:border-transparent dark:bg-brand-500/20 dark:text-brand-400">
                  {{ strtoupper(substr($guest->name, 0, 2)) }}
                </div>
                <div>
                  <div class="text-sm font-bold text-slate-800 transition-colors group-hover:text-brand-600 dark:text-stone-200 dark:group-hover:text-brand-400">
                    {{ $guest->name }}
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-sm font-medium text-slate-700 dark:text-stone-300">{{ $guest->school }}</span>
            </td>
            <td class="px-6 py-4">
              <span class="text-sm text-slate-600 dark:text-stone-400">{{ $guest->phone_number ?? '-' }}</span>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-slate-700 dark:text-stone-300">{{ $guest->created_at->format('d M Y, H:i') }}</div>
              <div class="text-xs text-slate-400 dark:text-stone-500">{{ $guest->created_at->diffForHumans() }}</div>
            </td>
            <td class="px-6 py-4 text-right">
              <div class="flex items-center justify-end gap-1">
                <button
                  data-modal-target="editGuestModal-{{ $guest->id }}"
                  class="rounded-lg p-1.5 text-slate-400 transition-colors hover:bg-brand-50 hover:text-brand-600 dark:hover:bg-brand-500/10 dark:hover:text-brand-400"
                  title="Edit"
                >
                  <i class="hgi-stroke hgi-edit-02 text-lg"></i>
                </button>
                <button
                  data-modal-target="deleteGuestModal-{{ $guest->id }}"
                  class="rounded-lg p-1.5 text-slate-400 transition-colors hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10 dark:hover:text-red-400"
                  title="Hapus"
                >
                  <i class="hgi-stroke hgi-delete-02 text-lg"></i>
                </button>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="px-6 py-16 text-center">
              <div class="flex flex-col items-center">
                <i class="hgi-stroke hgi-user-group text-5xl text-slate-300 dark:text-stone-600 mb-4"></i>
                <p class="text-lg font-semibold text-slate-400 dark:text-stone-500">Belum ada tamu terdaftar</p>
                <p class="mt-1 text-sm text-slate-400 dark:text-stone-500">Tambahkan tamu atau bagikan link form ke pengunjung</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($guests->hasPages())
    <div class="flex items-center justify-between border-t border-slate-100 bg-white p-4 sm:p-6 dark:border-transparent dark:bg-dark-card">
      <div class="text-sm text-slate-500 dark:text-stone-400">
        Halaman {{ $guests->currentPage() }} dari {{ $guests->lastPage() }}
      </div>
      <div class="flex items-center gap-2">
        @if($guests->onFirstPage())
        <span class="flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-400 dark:border-transparent dark:text-stone-600">
          <i class="hgi-stroke hgi-arrow-left-01 text-lg"></i>
        </span>
        @else
        <a href="{{ $guests->previousPageUrl() }}" class="flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition-all hover:bg-slate-50 hover:text-slate-900 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
          <i class="hgi-stroke hgi-arrow-left-01 text-lg"></i>
        </a>
        @endif

        @foreach($guests->getUrlRange(max(1, $guests->currentPage() - 2), min($guests->lastPage(), $guests->currentPage() + 2)) as $page => $url)
        @if($page == $guests->currentPage())
        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-600 text-sm font-semibold text-white">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-sm font-medium text-slate-600 transition-all hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">{{ $page }}</a>
        @endif
        @endforeach

        @if($guests->hasMorePages())
        <a href="{{ $guests->nextPageUrl() }}" class="flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-600 transition-all hover:bg-slate-50 hover:text-slate-900 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
          <i class="hgi-stroke hgi-arrow-right-01 text-lg"></i>
        </a>
        @else
        <span class="flex h-9 items-center rounded-lg border border-slate-200 px-3 text-sm font-medium text-slate-400 dark:border-transparent dark:text-stone-600">
          <i class="hgi-stroke hgi-arrow-right-01 text-lg"></i>
        </span>
        @endif
      </div>
    </div>
    @endif
  </div>

  @push('modals')
  <!-- Modals for Guests -->
  @foreach($guests as $guest)
  <!-- Edit Modal -->
  <div id="editGuestModal-{{ $guest->id }}" class="modal modal-hidden">
    <div class="modal-dialog w-full max-w-lg rounded-2xl bg-white p-0 shadow-2xl dark:bg-dark-card">
      <div class="flex items-center justify-between border-b border-slate-100 p-6 dark:border-transparent">
        <div>
          <h2 class="text-lg font-bold text-slate-800 dark:text-stone-100">Edit Data Tamu</h2>
          <p class="mt-1 text-sm text-slate-500 dark:text-stone-400">Perbarui informasi tamu</p>
        </div>
        <button data-modal-close class="rounded-lg p-1.5 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-dark-hover dark:hover:text-stone-200">
          <i class="hgi-stroke hgi-cancel-01 text-lg"></i>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.guests.update', $guest) }}" class="p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ $guest->name }}" required
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Asal Sekolah <span class="text-red-500">*</span></label>
            <input type="text" name="school" value="{{ $guest->school }}" required
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">No. HP</label>
            <input type="text" name="phone_number" value="{{ $guest->phone_number }}"
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-3">
          <button type="button" data-modal-close class="h-10 rounded-xl border border-slate-200 px-4 text-sm font-semibold text-slate-600 transition-all hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
            Batal
          </button>
          <button type="submit" class="h-10 rounded-xl bg-brand-600 px-4 text-sm font-semibold text-white shadow-md shadow-brand-500/20 transition-all hover:bg-brand-700 active:scale-95">
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div id="deleteGuestModal-{{ $guest->id }}" class="modal modal-hidden">
    <div class="modal-dialog w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-dark-card text-center">
      <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-500/20 dark:text-red-400">
        <i class="hgi-stroke hgi-alert-circle text-2xl"></i>
      </div>
      <h2 class="text-xl font-bold text-slate-800 dark:text-stone-100">Hapus Tamu?</h2>
      <p class="mt-2 text-sm text-slate-500 dark:text-stone-400">
        Apakah Anda yakin ingin menghapus <strong>{{ $guest->name }}</strong> dari daftar buku tamu? Data yang dihapus tidak dapat dikembalikan.
      </p>
      
      <div class="mt-8 flex items-center justify-center gap-3">
        <button type="button" data-modal-close class="flex-1 h-11 rounded-xl border border-slate-200 px-4 font-semibold text-slate-600 transition-all hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
          Batal
        </button>
        <form method="POST" action="{{ route('admin.guests.destroy', $guest) }}" class="flex-1">
          @csrf
          @method('DELETE')
          <button type="submit" class="w-full h-11 rounded-xl bg-red-600 px-4 font-semibold text-white shadow-md shadow-red-500/20 transition-all hover:bg-red-700 active:scale-95">
            Ya, Hapus
          </button>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  <!-- Add Guest Modal -->
  <div id="addGuestModal" class="modal modal-hidden">
    <div class="modal-dialog w-full max-w-lg rounded-2xl bg-white p-0 shadow-2xl dark:bg-dark-card">
      <div class="flex items-center justify-between border-b border-slate-100 p-6 dark:border-transparent">
        <div>
          <h2 class="text-lg font-bold text-slate-800 dark:text-stone-100">Tambah Tamu Baru</h2>
          <p class="mt-1 text-sm text-slate-500 dark:text-stone-400">Masukkan informasi tamu</p>
        </div>
        <button data-modal-close class="rounded-lg p-1.5 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-dark-hover dark:hover:text-stone-200">
          <i class="hgi-stroke hgi-cancel-01 text-lg"></i>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.guests.store') }}" class="p-6">
        @csrf
        <div class="space-y-4">
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" required placeholder="Masukkan nama tamu"
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Asal Sekolah <span class="text-red-500">*</span></label>
            <input type="text" name="school" required placeholder="Masukkan asal sekolah"
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
          <div>
            <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">No. HP</label>
            <input type="text" name="phone_number" placeholder="Masukkan nomor HP (opsional)"
              class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
          </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-3">
          <button type="button" data-modal-close class="h-10 rounded-xl border border-slate-200 px-4 text-sm font-semibold text-slate-600 transition-all hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
            Batal
          </button>
          <button type="submit" class="h-10 rounded-xl bg-brand-600 px-4 text-sm font-semibold text-white shadow-md shadow-brand-500/20 transition-all hover:bg-brand-700 active:scale-95">
            Tambah Tamu
          </button>
        </div>
      </form>
    </div>
  </div>
  @endpush

  <!-- Validation Errors -->
  @if($errors->any())
  <div class="animate-fade-in fixed bottom-6 right-6 z-50 w-96 rounded-xl border border-red-200 bg-red-50 p-4 shadow-lg dark:border-red-500/20 dark:bg-red-500/10">
    <div class="flex items-start gap-3">
      <i class="hgi-stroke hgi-alert-circle text-xl text-red-600 dark:text-red-400 mt-0.5"></i>
      <div>
        <p class="text-sm font-semibold text-red-700 dark:text-red-300">Terjadi kesalahan:</p>
        <ul class="mt-1 list-disc pl-4 text-sm text-red-600 dark:text-red-400">
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  @endif
@endsection
