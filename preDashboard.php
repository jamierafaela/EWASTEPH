<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Completion Popup</title>
    <link rel="stylesheet" href="ewasteWeb.css">
</head>
<body>
    <div class="mainmodal">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Complete Your Profile</h2>
            <div class="close-button">
                <input type="submit" value="X" name="close">
            </div>
        </div>
        <div class="modal-body">
            <p class="instruction-text">Please complete your profile information to continue</p>

            <form>
                <!-- Full Name -->
                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" placeholder="Enter your full name">
                </div>
                
                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label">Email Address *</label>
                    <input type="email" class="form-control readonly" value="user@example.com" readonly required>
                    <span class="verified-badge">(verified)</span>
                </div>
                
                <!-- Phone Number -->
                <div class="form-group">
                    <label class="form-label">Phone Number *</label>
                    <input type="tel" class="form-control" placeholder="Enter your phone number" required>
                </div>
                
                <!-- Shipping Address -->
                <div class="form-group">
                    <label class="form-label">Shipping Address *</label>
                    <input type="text" class="form-control" placeholder="Enter your shipping address" required>
                </div>
                
                <!-- Two Column Section -->
                <div class="two-column">
                    <!-- Profile Picture -->
                    <div class="column">
                        <label class="form-label">Profile Picture (optional)</label>
                        <div class="profile-picture-container">
                            <input type="submit" value="Upload Image" name="submit">
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="column">
                        <label class="form-label">Payment Methods *</label>
                        <select class="payment-method">
                            <option value="" selected disabled>--- Select a Method ---</option>
                            <option value="red">Gcash</option>
                            <option value="green">Card</option>
                            <option value="blue">Cash-on-delivery</option>
                       </select>
                    </div>
                </div>
        </div>
        
        <div class="modal-footer">
            <p class="required-fields-note">* Required fields</p>
            <button type="reset">Reset</button>
            <button type="submit" class="submit-button">Save & Continue</button>
        </div>
    </form>

    </div>
    </div>
</body>
</html>