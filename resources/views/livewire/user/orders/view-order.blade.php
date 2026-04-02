<div>
    <div class="tab-content" id="pills-tabContent">

        <!-- تبويب: جميع الطلبات -->
        <div class="tab-pane fade show active" id="pills-all">
            @foreach ($orders as $order)
                @livewire('user.orders.order', ['order' => $order, 'user' => $this->user], key($order->id))
            @endforeach
        </div>
        <!-- نهاية تبويب الكل -->

        <!-- تبويبات أخرى (نشطة ومكتملة) يمكن ملؤها بنفس الطريقة -->
    </div>
    {{ $orders->links() }}
</div>
