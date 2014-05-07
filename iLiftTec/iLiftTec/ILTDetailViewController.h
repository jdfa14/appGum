//
//  ILTDetailViewController.h
//  iLiftTec
//
//  Created by Ivan Diaz on 3/23/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ILTDetailViewController : UIViewController

@property (strong, nonatomic) id detailItem;
- (IBAction)butonEnviar:(id)sender;
@property (strong, nonatomic) IBOutlet UITextView *comentariosTV;

@property (weak, nonatomic) IBOutlet UILabel *detailDescriptionLabel;

@property (strong, nonatomic) NSMutableDictionary *avance;

@end
