@extends('layouts.app')
@section('title', 'Kelola Pengguna')

@section('content')
    <div class="page-header">
        <div class="breadcrumb"><a href="{{ route('rt.dashboard') }}">Dashboard</a> <i class="fas fa-chevron-right"
                style="font-size:.7rem;"></i> <span>Kelola Pengguna</span></div>
        <h1 class="page-title">Kelola Pengguna 👥</h1>
        <p class="page-subtitle">Manajemen akun masyarakat yang terdaftar.</p>
    </div>

    <div class="card" style="margin-bottom:1.5rem;">
        <form method="GET" class="flex gap-3 items-center" style="flex-wrap:wrap;">
            <div style="flex:1;min-width:200px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..."
                    value="{{ request('search') }}">
            </div>
            <div>
                <select name="role" class="form-control">
                    <option value="">Semua Role</option>
                    <option value="masyarakat" {{ request('role') == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                    <option value="rt" {{ request('role') == 'rt' ? 'selected' : '' }}>RT</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
            @if (request()->hasAny(['search', 'role']))
                <a href="{{ route('rt.users.index') }}" class="btn btn-outline"><i class="fas fa-times"></i> Reset</a>
            @endif
        </form>
    </div>

    <div class="card">
        @if ($userList->isEmpty())
            <div style="text-align:center; padding:3rem 0; color:var(--text-muted);">
                <i class="fas fa-users-slash" style="font-size:2.5rem; opacity:.2; display:block; margin-bottom:1rem;"></i>
                <p style="font-weight: 500;">Tidak ada pengguna ditemukan.</p>
            </div>
        @else
            {{-- Desktop View --}}
            <div class="desktop-table">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Pengguna</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userList as $i => $u)
                                <tr>
                                    <td style="color: var(--text-muted); font-weight: 600;">
                                        {{ $userList->firstItem() + $i }}</td>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:.75rem;">
                                            <div
                                                style="width:36px; height:36px; border-radius:50%; background: var(--bg-muted); color: var(--primary); display:flex; align-items:center; justify-content:center; font-weight:800; font-size:.85rem; border: 1px solid var(--border);">
                                                {{ strtoupper(substr($u->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div style="font-weight:700; font-size:.9rem; color: var(--text);">
                                                    {{ $u->name }}</div>
                                                <div style="font-size:.75rem; color:var(--text-muted);">{{ $u->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-size:.85rem; font-weight: 600;">{{ $u->no_hp ?? '—' }}</td>
                                    <td style="font-size:.8rem; color:var(--text-muted);">
                                        {{ $u->alamat ? Str::limit($u->alamat, 40) : '—' }}</td>
                                    <td><span
                                            class="badge badge-{{ $u->role }}">{{ $u->role === 'rt' ? 'RT' : 'Warga' }}</span>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:.5rem;">
                                            <a href="{{ route('rt.users.edit', $u) }}" class="btn btn-sm btn-outline"
                                                title="Edit"><i class="fas fa-edit"></i></a>
                                            @if ($u->id !== auth()->id())
                                                <form method="POST" action="{{ route('rt.users.destroy', $u) }}"
                                                    onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        style="background: transparent; color: var(--danger); border: 1px solid #fee2e2;"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile View --}}
            <div class="mobile-list">
                @foreach ($userList as $u)
                    <div
                        style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.25rem;">
                        <div
                            style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div
                                    style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 800;">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 800; font-size: 1rem; color: var(--text);">{{ $u->name }}
                                    </div>
                                    <span class="badge badge-{{ $u->role }}"
                                        style="font-size: 0.65rem;">{{ $u->role === 'rt' ? 'RT' : 'Warga' }}</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('rt.users.edit', $u) }}" class="btn btn-sm btn-outline"
                                    style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i
                                        class="fas fa-edit"></i></a>
                                @if ($u->id !== auth()->id())
                                    <form method="POST" action="{{ route('rt.users.destroy', $u) }}"
                                        onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline"
                                            style="width: 32px; height: 32px; padding: 0; justify-content: center; color: var(--danger); border-color: #fee2e2;"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div
                            style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; border-top: 1px solid var(--border); padding-top: 0.75rem;">
                            <div>
                                <div
                                    style="font-size: 0.7rem; text-transform: uppercase; font-weight: 800; color: var(--text-muted); margin-bottom: 0.15rem;">
                                    Email</div>
                                <div
                                    style="font-size: 0.85rem; font-weight: 600; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ $u->email }}</div>
                            </div>
                            <div>
                                <div
                                    style="font-size: 0.7rem; text-transform: uppercase; font-weight: 800; color: var(--text-muted); margin-bottom: 0.15rem;">
                                    No. HP</div>
                                <div style="font-size: 0.85rem; font-weight: 600; color: var(--text);">
                                    {{ $u->no_hp ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($userList->hasPages())
                <div class="pagination" style="margin-top: 1.5rem;">
                    @if ($userList->onFirstPage())
                        <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i
                                class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $userList->previousPageUrl() }}" class="btn btn-outline"><i
                                class="fas fa-chevron-left"></i></a>
                    @endif
                    <span
                        style="font-weight: 700; color: var(--text-muted); padding: 0 1rem; font-size: 0.875rem;">{{ $userList->currentPage() }}
                        / {{ $userList->lastPage() }}</span>
                    @if ($userList->hasMorePages())
                        <a href="{{ $userList->nextPageUrl() }}" class="btn btn-outline"><i
                                class="fas fa-chevron-right"></i></a>
                    @else
                        <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i
                                class="fas fa-chevron-right"></i></span>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endsection
