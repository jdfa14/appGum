//
//  ILTLogInViewController.m
//  iLiftTec
//
//  Created by Ivan Diaz on 4/3/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTLogInViewController.h"
#import "ILTJsonManager.h"

#define link http://localhost/~ivandiaz;

@interface ILTLogInViewController ()

@end

@implementation ILTLogInViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the
    
    NSUserDefaults *fetchDefaults = [NSUserDefaults standardUserDefaults];
    
    // getting an NSString
    NSString *password = [fetchDefaults objectForKey:@"kPassword"];
    NSString *user = [fetchDefaults objectForKey:@"kUser"];
    
    if (password == nil || user == nil) {
        return;
    } else if([self intentaLoginUser:user password:password]) {
        NSLog(@"Login SUCCESS  con guardados");
        [self performSegueWithIdentifier:@"correct" sender:self];
        
        
    }
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender
{
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

- (void) alertStatus:(NSString *)msg :(NSString *)title
{
    UIAlertView *alertView = [[UIAlertView alloc] initWithTitle:title
                                                        message:msg
                                                       delegate:self
                                              cancelButtonTitle:@"Ok"
                                              otherButtonTitles:nil, nil];
    
    [alertView show];
}

-(void) tryLogIn{
    
}

- (IBAction)loginButton:(id)sender {
    
    if([[_usuarioTF text] isEqualToString:@""] || [[_contrasenaTF text] isEqualToString:@""] ) {
        [self alertStatus:@"Please enter both Username and Password" :@"Login Failed!"];
    } else if([self intentaLoginUser:[_usuarioTF text] password:[_contrasenaTF text]]) {
        
        
        NSUserDefaults *userDef = [NSUserDefaults standardUserDefaults];
        
        [userDef setObject:[_usuarioTF text] forKey:@"kUser"];
        [userDef setObject:[_contrasenaTF text] forKey:@"kPassword"];
        
        [userDef synchronize];
        
        [self performSegueWithIdentifier:@"correct" sender:self];
        
    }
    
    //[self alertStatus:@"Logged in Successfully." :@"Login Success!"];
    }

-(BOOL) intentaLoginUser: (NSString *) user password: (NSString *) password {
       
    NSString *post =[[NSString alloc] initWithFormat:@"idAlumno=%@&contrasena=%@",user,password];
    NSString *url = @"http://localhost/~ivandiaz/servidor/alumnoInicioSesion.php";
    ILTJsonManager *JsonManager = [[ILTJsonManager alloc] init];
    NSDictionary *jsonData = [JsonManager jsonHandler:url parametros:post];
    
    if(jsonData){
        NSInteger success = [(NSNumber *) [jsonData objectForKey:@"success"] integerValue];
        
        if(success == 1)
        {
            return TRUE;
        } else {
            NSString *error_msg = (NSString *) [jsonData objectForKey:@"error_message"];
            [self alertStatus:error_msg :@"Login Failed!"];
        }
    }
    
    return false;
}

- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event {
    
    [[self view] endEditing:TRUE];
    
}
@end
