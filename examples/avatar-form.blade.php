<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avatar Generator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        select, input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .avatar-preview {
            text-align: center;
            margin: 20px 0;
        }
        .avatar-preview img {
            max-width: 200px;
            max-height: 200px;
            border: 3px solid #ddd;
            border-radius: 10px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Avatar Generator for User #{{ $userId }}</h1>
        
        <div id="message"></div>
        
        @if($currentAvatar)
            <div class="avatar-preview">
                <h3>Current Avatar</h3>
                <img src="{{ $currentAvatar }}" alt="Current Avatar" id="currentAvatar">
            </div>
        @endif
        
        <form id="avatarForm" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="age_group">Age Group:</label>
                <select name="age_group" id="age_group" required>
                    @foreach($ageGroups as $ageGroup)
                        <option value="{{ $ageGroup }}">{{ ucfirst($ageGroup) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" required>
                    @foreach($genders as $gender)
                        <option value="{{ $gender }}">{{ ucfirst($gender) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="personality">Personality:</label>
                <select name="personality" id="personality" required>
                    @foreach($personalities as $personality)
                        <option value="{{ $personality }}">{{ ucfirst($personality) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="state">State (Optional):</label>
                <select name="state" id="state">
                    <option value="">-- Select State --</option>
                    @foreach($states as $state)
                        <option value="{{ $state }}">{{ ucfirst(str_replace('_', ' ', $state)) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="profile_picture">Profile Picture (Optional):</label>
                <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
            </div>
            
            <button type="submit" class="btn">Generate Avatar</button>
        </form>
    </div>

    <script>
        document.getElementById('avatarForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const messageDiv = document.getElementById('message');
            
            try {
                const response = await fetch('/avatar/generate/{{ $userId }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    messageDiv.innerHTML = '<div class="alert alert-success">Avatar generated successfully!</div>';
                    
                    // Update the current avatar display
                    if (result.avatar_url) {
                        const avatarImg = document.getElementById('currentAvatar');
                        if (avatarImg) {
                            avatarImg.src = result.avatar_url + '?t=' + Date.now(); // Add timestamp to force reload
                        } else {
                            // Create new avatar preview if it doesn't exist
                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'avatar-preview';
                            previewDiv.innerHTML = `
                                <h3>Generated Avatar</h3>
                                <img src="${result.avatar_url}" alt="Generated Avatar" id="currentAvatar">
                            `;
                            document.getElementById('avatarForm').parentNode.insertBefore(previewDiv, document.getElementById('avatarForm'));
                        }
                    }
                } else {
                    messageDiv.innerHTML = '<div class="alert alert-error">Error: ' + result.error + '</div>';
                }
            } catch (error) {
                messageDiv.innerHTML = '<div class="alert alert-error">Error: ' + error.message + '</div>';
            }
        });
    </script>
</body>
</html>
