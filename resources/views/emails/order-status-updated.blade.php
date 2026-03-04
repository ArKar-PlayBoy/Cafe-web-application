<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Updated</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #16a34a, #15803d); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .status-box { background: white; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: center; }
        .status-old { color: #6b7280; text-decoration: line-through; }
        .status-new { color: #16a34a; font-weight: bold; font-size: 1.25rem; }
        .arrow { font-size: 1.5rem; margin: 0 10px; }
        .footer { text-align: center; margin-top: 20px; color: #6b7280; font-size: 0.875rem; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Order Update</h1>
        <p style="margin: 10px 0 0 0;">Your order status has been updated</p>
    </div>
    
    <div class="content">
        <div class="status-box">
            <p style="margin-bottom: 15px; color: #6b7280;">Order #{{ $order->id }}</p>
            <div>
                <span class="status-old">{{ ucfirst($oldStatus) }}</span>
                <span class="arrow">→</span>
                <span class="status-new">{{ ucfirst($newStatus) }}</span>
            </div>
        </div>
        
        <p>
            @if($newStatus === 'ready')
                Great news! Your order is ready for pickup. Please visit the cafe to collect your order.
            @elseif($newStatus === 'preparing')
                Your order is now being prepared by our baristas.
            @elseif($newStatus === 'completed')
                Thank you! We hope you enjoyed your order. See you again soon!
            @elseif($newStatus === 'cancelled')
                Your order has been cancelled. If you have any questions, please contact us.
            @else
                Your order status has been updated to: {{ ucfirst($newStatus) }}
            @endif
        </p>
        
        <div class="footer">
            <p>© {{ date('Y') }} Cafe. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
