//
//  ILTMusculoTableViewCell.h
//  iLiftTec
//
//  Created by Ivan Diaz on 3/27/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ILTMasterViewController.h"
#import "ILTJsonManager.h"

@interface ILTMusculoTableViewCell : UITableViewCell
@property (strong, nonatomic) IBOutlet UILabel *musculoLabel;
@property (nonatomic, assign) BOOL buttonIsOn;
- (IBAction)checkButton:(id)sender;
@property (strong, nonatomic) IBOutlet UILabel *seriesL;
@property (strong, nonatomic) IBOutlet UILabel *repeticionesL;
@property (strong, nonatomic) IBOutlet UIButton *checkB;
@property (strong, nonatomic) id delegado;
@property (nonatomic) NSIndexPath *indexPath;

@property (strong, nonatomic) ILTMasterViewController *papa;

-(void) updateImage;

@end
