//
//  ILTLogInViewController.h
//  iLiftTec
//
//  Created by Ivan Diaz on 4/3/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ILTLogInViewController : UIViewController

@property (strong, nonatomic) IBOutlet UITextField *usuarioTF;
@property (strong, nonatomic) IBOutlet UITextField *contrasenaTF;
//@property (strong, nonatomic) NSString "http://localhost/~ivandiaz";

- (IBAction)loginButton:(id)sender;
@end
