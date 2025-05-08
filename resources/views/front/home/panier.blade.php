@extends('layouts.home')

@section('content')
    @if (count($panierItemsParBoutique) > 0)
    <div class="mb-4 rounded border p-3">
        @foreach ($panierItemsParBoutique as $key => $boutiques)
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Total</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boutiques as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->produit->image }}" alt="{{ $item->produit->name }}" class="img-thumbnail" style="width: 64px; height: 4px; object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $item->produit->name }}</strong>
                            </td>
                            <td>${{ $item->produit->price }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1">
                                    <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="decrease" value="1">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="produit_id" value="{{ $item->produit->id }}">
                                        <button type="submit"  style="border: none; padding: 15px; background-color: rgb(57, 57, 57); border-radius: 4px; color: rgb(255, 255, 255); margin-top: 22px;">-</button>
                                    </form>
                                    <input type="text" value="{{ $item->quantity }}"  style="border: none; padding: 15px; width: 50px; background-color: white; border-radius: 4px; box-shadow: 0 0 10px 1px rgba(0,0,0,0.1); color: red;" />
                                    <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="decrease" value="0">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="produit_id" value="{{ $item->produit->id }}">
                                        <button type="submit"  style="border: none; padding: 15px; background-color: rgb(57, 57, 57); border-radius: 4px; color: rgb(255, 255, 255); margin-top: 22px;">+</button>
                                    </form>
                                </div>
                            </td>
                            <td>${{ $item->quantity * $item->produit->price }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <form action="{{ route('buyer.panierItem.destroy', ['panier_item' => $item->id]) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="" style="border: none; padding: 20px; background-color: white; border-radius: 4px; box-shadow: 0 0 10px 1px rgba(0,0,0,0.1); color: red; margin-top: 22px;">
                                        <i class="fi fi-rr-trash"></i> <!-- Utilise Bootstrap Icons -->
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-100 d-flex flex-column justify-content-end align-items-end gap-2">
            <div style="font-size: 1.2rem">Total de la commande : <span style="font-weight: bold;">${{ $boutiques->money }}</span></div>
            <div class="">
                <form action="{{ route('buyer.commande.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="boutique_id" value="{{ $key }}">
                    <input type="hidden" name="total" value="{{ $boutiques->money }}">
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="btn btn-outline-grey d-flex gap-2 align-items-center"><span style="margin-top: 5px;"><i class="fi fi-rr-usd-circle"></span></i><span>Passer la commande</span></button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="" style="padding: 40px 40px; display: flex; align-items: center; justify-content: center;">
            Aucun produits n'est ajouté au panier.
        </div>
    @endif
@endsection
