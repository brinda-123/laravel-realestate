<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Property Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }
        .property-details {
            margin-top: 20px;
        }
        .property-details p {
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Property Submission</h2>
        </div>
        
        <div class="content">
            <p>Hello,</p>
            
            <p>A new property has been submitted by {{ $sellerName }}. Here are the details:</p>
            
            <div class="property-details">
                <p><strong>Property Name:</strong> {{ $propertyData['property_name'] }}</p>
                <p><strong>Status:</strong> {{ ucfirst($propertyData['property_status']) }}</p>
                <p><strong>Price Range:</strong> ${{ number_format($propertyData['lowest_price']) }} - ${{ number_format($propertyData['max_price']) }}</p>
                <p><strong>Bedrooms:</strong> {{ $propertyData['bedrooms'] }}</p>
                <p><strong>Bathrooms:</strong> {{ $propertyData['bathrooms'] }}</p>
                <p><strong>Garage:</strong> {{ $propertyData['garage'] }}</p>
                <p><strong>Garage Size:</strong> {{ $propertyData['garage_size'] }}</p>
                <p><strong>Description:</strong><br>{{ $propertyData['property_description'] }}</p>
            </div>
            
            <p>Please review this property submission and take appropriate action.</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
