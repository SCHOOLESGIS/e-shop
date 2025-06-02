@extends('layouts.home')

@section('content')
    <div class="mb-4 rounded border p-3">
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
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                @if ($item->produit->image != null)
                                    <img src="{{ asset('storage/'.$item->produit->image) }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                @else
                                    <img src="{{ asset("images/produitbl.jpg") }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                @endif
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
        <div class="d-flex flex-column justify-content-end align-items-end gap-2" style="width: 100%;">
            <div style="font-size: 1.2rem">Total de la commande : <span style="font-weight: bold;">${{ $money }}</span></div>
            <div class="d-flex flex-column justify-content-end align-items-end" style="width: 100%;">
                <form action="{{ route('buyer.commande.store') }}" method="POST" style="width: 100%;">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);"><img src="{{ asset('payment/mastercard.jpg') }}" style="width: 75px;" alt=""></th>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);"><img src="{{ asset('payment/visa.jpg') }}" style="width: 75px;" alt=""></th>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);"><img src="{{ asset('payment/unionpay.jpg') }}" style="width: 75px;" alt=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col" style="padding: 20px;"><input type="radio" name="payment" value="mastercard" style="cursor: pointer;"> masterCard</td>
                                <td scope="col" style="padding: 20px;"><input type="radio" name="payment" value="visa" style="cursor: pointer;">Visa</td>
                                <td scope="col" style="padding: 20px;"><input type="radio" name="payment" value="unionpay" style="cursor: pointer;">UnionPay</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);">Numéro d'identification</th>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);">CVV</th>
                                <th scope="col" style="padding-left: 20px; width: calc(100%/3);">Date d'expiration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col" style="padding: 20px;"><input type="text" name="niu" placeholder="xxxx-xxxx-xxxx-xxxx" style="height: 100%; width: 100%; padding: 15px; border: 1px solid black; outline:none; border-radius:4px;"></td>
                                <td scope="col" style="padding: 20px;"><input type="text" name="cvv" placeholder="xxx"  style="height: 100%; width: 100%; padding: 15px; border: 1px solid black; outline:none; border-radius:4px;"></td>
                                <td scope="col" style="padding: 20px;"><input type="text" name="exp" placeholder="01/25"  style="height: 100%; width: 100%; padding: 15px; border: 1px solid black; outline:none; border-radius:4px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    @csrf
                    @method('POST')
                    <input type="hidden" name="boutique_id" value="{{ $boutique->id }}">
                    <input type="hidden" name="total" value="{{ $money }}">
                    <input type="hidden" name="status" value="pending">
                    <button type="submit" class="btn btn-outline-grey d-flex gap-2 align-items-center"><span style="margin-top: 5px;"><i class="fi fi-rr-usd-circle"></span></i><span>Payer la commande</span></button>
                </form>
            </div>
        </div>
    </div>
@endsection
